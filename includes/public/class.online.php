<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class bbPress_Advanced_Statistics_Online {

	/**
	 * The single instance of bbPress_Advanced_Statistics_Online.
	 * @var 	object
	 * @access      private
	 * @since 	1.0.0
	 */
	private static $_instance = null;
        
        /**
	 * The current user's ID
	 * @var         int
	 * @access      private
	 * @since       1.0.0
	 */
	private $_userID = 0;
        
        /**
	 * WordPress DB object
	 * @var         object
	 * @access      private
	 * @since       1.3.0
	 */
	private $_db;
        
        /**
	 * Plugin table name
	 * @var         object
	 * @access      private
	 * @since       1.3.0
	 */
	private $_table;
        
         /**
	 * SQL Time
	 * @var         object
	 * @access      private
	 * @since       1.3.0
	 */
	private $_sqlTime;
        
        /**
	 * Constructor function.
	 * @access      public
	 * @since       1.0.0
	 * @return      void
	 */
	public function __construct ( $parent ) {
            
            $this->parent = $parent;
            
            // Create the wpdb db object and some helpful variables
            global $wpdb;
            $this->_db = $wpdb;
            $this->_table = $this->_db->prefix . "bbpas";
            $this->_sqlTime = current_time('mysql');
            
            // Set the user data we need
            add_action('init', array( $this, 'setUserData' ), 10 );            
            
            // hook our status updates into the appropriate hooks
            add_action( 'template_redirect', array( $this, 'userActivity' ), 10 );  
            add_action( 'clear_auth_cookie', array( $this, 'userLoggedOut' ), 10 );
			
            // Hook into bbPress if the user has set the plugin to do so within settings
            $this->bbpress_hook_display();
            
	} // End __construct ()        
        
	/**
	 * Main bbPress_Advanced_Statistics_Online Instance
	 *
	 * Ensures only one instance of bbPress_Advanced_Statistics_Online is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see bbPress_Advanced_Statistics()
	 * @return Main bbPress_Advanced_Statistics_Online instance
	 */
	public static function instance ( $file = '', $version ) {
		if ( is_null( self::$_instance ) ) {
                    self::$_instance = new self( $file, $version );
		}
		return self::$_instance;
	} // End instance ()
        
        
        /**
         * update_lastactivity
         * 
         * Updates the DB value for the user id passed, uses WP's current_time
         * functionality. 
         * 
         * This is also how statuses are updated too (e.g logout)
         * 
         * @since 1.0.0
         * @param int $userID
         * @param int $status
         * 
         * @return void
         */
        
        public function update_lastactivity( $userID, $status ) {
            if( is_user_logged_in() && !is_null( $userID ) )
            {                
                $this->_db->replace(
                        $this->_table,
                        array( 
                            'userid' => $userID,
                            'date_recorded' => current_time('mysql'),
                            'status' => $status
                        )
                    );
            }
        }
               
        /**
         * userLoggedOut
         * 
         * Hooked into clear_auth_cookie, wp_logout is too late as we need to
         * retain the ID to set the correct flag with the db. 
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        
        public function userLoggedOut()
        {
            // Set the user's status to 0
            $this->update_lastactivity( $this->_userID, 0 );
        }
        
        /**
         * userActivity
         * 
         * Hooked into template_redirect to be run each time the user
         * changes the page, simply runs the update_lastactivity function 
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        public function userActivity()
        {
            $this->update_lastactivity( $this->_userID, 1 );
        }
        
        /**
         * setUserData
         * 
         * Sets up the required user data for us, hooked into init. 
         * 
         * @since 1.0.0
         * 
         * @return void
         */
	public function setUserData()
        {
            $this->_userID = wp_get_current_user()->ID;
        }
        
        /**
         * Fetches the currently active users
         * @since 1.0.0
         * 
         * @return WP_Query object
         */
        private function get_ActiveUsers()
        {            
           $query = $this->_db->get_results(
                    "SELECT p.date_recorded as date_recorded, 
                    p.id, p.userid, p.status, 
                    w.user_nicename, w.user_login, w.display_name 
                    FROM " . $this->_table . " AS p 
                    INNER JOIN " . $this->_db->prefix . "users AS w ON w.id = p.userid 
                    WHERE date_recorded >= NOW() - INTERVAL " . $this->parent->option['user_activity_time'] . " HOUR 
                    AND (p.userid, p.date_recorded) IN (SELECT userid, MAX(date_recorded) FROM " . $this->_table . "
                            WHERE date_recorded >= NOW() - INTERVAL " . $this->parent->option['user_activity_time'] . " HOUR 
                            GROUP BY userid )
                    ORDER BY date_recorded DESC", OBJECT
                    ); 
                
           return $query;     
        }
        
        /**
         * Start building up the array of users online
         * @access public
         * @since 1.0.0
         * @return string
         */
        public function whois_online() {
            
            // Fetch the user array
            $users = $this->get_ActiveUsers();
                                    
            $markup = array();
            
            // Loop through our users and work out where they need to go
            foreach( $users as $user ) {
                
                $user_lastactivity = $user->date_recorded;
                
                // Format the user link
                $current_user = $this->get_user_link( $user );
                $user_role = str_replace(' ', '-', strtolower( bbp_get_user_display_role( $user->userid, $user->user_nicename ) ) );
                
                // The user will always appear in the inactive section
                $markup['inactive'][] = '<span class="bbp-topic-freshness-author '. $user_role . '">' . $current_user . '</span>';
                
                if( strtotime( $user_lastactivity ) > ( strtotime( $this->_sqlTime ) - ( $this->parent->option['user_inactivity_time'] * 60 ) )
                    && ( $user->status == 1 ) )
                {
                    $markup['active'][] = '<span class="bbp-topic-freshness-author '. $user_role . '">' . $current_user . '</span>';
                } 
            }

            return ( ( isset( $markup ) ? $markup : false ) );
        }
        
        /**
         * Return a user's value within the online users widget, alongside their
         * profile link
         * 
         * @param Obj $user
         * @since 1.0.0
         * @return string
         */
        private function get_user_link( $user ) {
            
            if( $this->parent->option['user_display_format'] == "display_as_username" ) {
                $name = $user->user_login;
            } else {
                $name = $user->display_name;
            }
            
            $nicetime = human_time_diff( strtotime( $user->date_recorded ), strtotime( $this->_sqlTime ) );
            
            // Build the individual link
            $link = '<a href="' . bbp_get_user_profile_url( $user->userid ) .
                    '"id="bbpress-advanced-statistics-' . $user->id . '' .
                    '"title="' . sprintf( 
                            /* translators: 1: formatted time */
                            __('Last Seen: %1$s ago', 'bbpress-improved-statistics-users-online'), 
                            $nicetime ) . '" class="bbpas-user">' . $name . '</a>';
            
            return $link;
        }
        
        /**
         * Creates the [bbpas-activity] shortcode content
         * @access public
         * @since 1.0.0
         * @return string
         */
        public function shortcode_activity()
        {
            $content = $this->whois_online();  
            
            /* Convert the value to an integer. This is a catch-all solution
            * to bad data, if someone decides to enter non-int values into the
            * db, this will simply convert it to 1... so trash data will result 
            * in only one record. 
            */            
            $limit = intval( $this->parent->option['user_display_limit'] );
            
            $markup = false;
            
            $HTMLOutput["version"] = "<!-- Added by bbPress Advanced Statistics " . BBPAS_VERS . " -->";
            
            $activeCount = 0;
            
            if( isset( $content["active"] ) ) {
                $activeCount = count( $content["active"] );
            }
            
            // Fetch the most active users
            $mostUsers = $this->get_mostusers( $activeCount );
            
            // Build the 'Currently Active' header if it has been enabled.
            if( is_array( $this->parent->option['stats_to_display'] ) 
                && in_array( 'last_x_mins', $this->parent->option['stats_to_display'] ) )
            {
                $HTMLOutput["active"] = $this->shortcode_tool_build_title( 
                    str_replace( array( "%MINS%", "%COUNT_ACTIVE_USERS%" ),
                    array( $this->parent->option['user_inactivity_time'], 
                        $activeCount ),
                        esc_html( $this->parent->option['title_text_currently_active'] ) ),
                    false );
            }            
            
            // If users active, start building the html for the users
            if( isset( $HTMLOutput["active"] ) ) 
            {
                if( isset( $content["active"] ) )
                {
                    foreach( $content["active"] as $key => $value )
                    {
                        // If the value is the last in the array, don't append a comma
                        $HTMLOutput["active"] .= $content["active"][$key] . (($content["active"][$key] === end($content["active"])) ? "" : ", " );
                    }
                } else {
                    $HTMLOutput["active"] .= __('No users are currently active', 'bbpress-improved-statistics-users-online'); 
                }
            }
            
            // Build the inactive users title
            if( is_array( $this->parent->option['stats_to_display'] ) 
                && in_array( 'last_x_hours', $this->parent->option['stats_to_display'] ) )
            {
                $HTMLOutput["inactive"] = $this->shortcode_tool_build_title( 
                        str_replace( array( "%HOURS%", "%COUNT_ALL_USERS%" ),
                        array( $this->parent->option['user_activity_time'], 
                            count( $content["inactive"] ) ),
                            esc_html( $this->parent->option['title_text_last_x_hours'] ) ), 
                        false ); 
            
                    // If users have been active in timeframe, build the html
                    if( isset( $content['inactive'] ) )
                    {
                        // To count where we are
                        $loopCount = 0;
                        $inactiveTotal = count( $content["inactive"] );
                        $displayLimit = intval($this->parent->option['user_display_limit']);
                        
                        foreach( $content["inactive"] as $key => $value )
                        {
                            // Count the loop iteration, check to see if we are over the limit.
                            $loopCount++;
                                                       
                            /*
                             * 1: check to see if the option is even enabled
                             * 2: compare the loopCount against the limit
                             * 3: make sure we aren't exactly at the total number of users online
                             */
                            if( $displayLimit > 0 
                                && $loopCount > $displayLimit 
                                && $inactiveTotal !== $displayLimit ) {
                                
                                $inactiveCount = ( count( $content["inactive"] ) - $displayLimit );
                                $link = "#";
                                
                                if( $this->parent->option['user_display_limit_link'] !== "-1" )
                                {
                                    $link = get_page_link( $this->parent->option['user_display_limit_link'] );
                                }
                                
                                $HTMLOutput["inactive"] .= " <a href=" . $link . " class='bbpas-others'>" . sprintf(
                                    __('and %1$s others', 'bbpress-improved-statistics-users-online'),
                                    $inactiveCount
                                ) . "</a>";
                            
                            break;
                                
                            }
                            
                            $HTMLOutput["inactive"] .= $content["inactive"][$key];
                            
                            if( $loopCount < $displayLimit && $loopCount < $inactiveTotal ) {
                                    $HTMLOutput["inactive"] .= ", ";
                                } else if( ( $displayLimit <= 0 ) 
                                        && ( $content["inactive"][$key] !== end($content["inactive"]) ) ) {
                                   $HTMLOutput["inactive"] .= ", ";
                                }                              
                        }
                    } else {
                        $HTMLOutput["inactive"] .= sprintf(
                                __('No users have been active within the last %1$s hours', 
                                    'bbpress-improved-statistics-users-online'),
                                $this->parent->option['user_activity_time']
                            );                
                    }
            }
            
            // Lets display the key
            if( $this->parent->option['user_group_key'] == "on" ) {
                $HTMLOutput["forum_key"] = '<div class="bbpas-key">' . $this->get_roles_key() . '</div>';
            }
            
            // Now check to see if BBPress Statistics are enabled
            if( $this->parent->option['bbpress_statistics'] == "on" || $this->parent->option['last_user'] == "on")
            {                
                
                $stats = $this->get_formatted_statistics();
                
                $HTMLOutput["forum_stats"] = $this->shortcode_tool_build_title( __('Forum Statistics', 'bbpress-improved-statistics-users-online'), false );
                
                if( $this->parent->option['bbpress_statistics'] == "on" ) {
                    $HTMLOutput["forum_stats"] .= '<span class="bbpas-title">' . __('Threads', 'bbpress-improved-statistics-users-online') . ": </span>{$stats['topic_count']}, " 
                    . '<span class="bbpas-title">' . __('Posts', 'bbpress-improved-statistics-users-online') . ": </span>{$stats['reply_count']}, "
                    . '<span class="bbpas-title">' . __('Members', 'bbpress-improved-statistics-users-online') . ": </span>{$stats['user_count']}<br>";
                }
                
                if( $this->parent->option['last_user'] == "on" ) {
                     // Grab the latest registered user on the site
                    $latest_user = $this->get_latestuser();                
                    $latest_user_name = ( ( $this->parent->option['user_display_format'] == "display_as_username" ) ? $latest_user->user_login :  $latest_user->display_name );
                
                    $HTMLOutput["forum_stats"] .= __('Welcome to our newest member', 'bbpress-improved-statistics-users-online') . ", <a href=\"" . bbp_get_user_profile_url( $latest_user->ID ) . "\">" . $latest_user_name . "</a>";
                }
                
                if( $this->parent->option['most_users_online'] == "on" ) {
                    $HTMLOutput["most_users"] = sprintf( 
                        /* translators: 1: total amount of users 2: date */
                        __('Most users ever online was %1$s on %2$s', 'bbpress-improved-statistics-users-online'),
                        "<span>" . $mostUsers['users'] . "</span>",
                        "<span>" . date( "d-m-Y H:i:s", strtotime( $mostUsers['date'] ) ) . "</span>" );
                }
            }
                        
            foreach($HTMLOutput as $key => $html ) {
                $markup .= "<div class='bbpas-" . $key . "' id='bbpas-" . $key . "'>" . $html . "</div>";
            }
                        
            return ( ( isset( $markup ) ? $markup : __('An error has occurred', 'bbpress-improved-statistics-users-online') ) );
        }
        
        /**
         * Returns the forum roles that are setup on the forum
         * @since 1.3.13
         * @return string
         */
        
        function get_roles_key() {
            
            $roles = bbp_get_dynamic_roles();
            $role_key = false;
            
            foreach( $roles as $key => $value )
            {
                $role_key .= "<span class=\"" . str_replace(' ', '-', strtolower($value['name']) ) . "\">" . $value['name'] . "</span>" . ( ( $value === end( $roles ) ) ? "" : " " . __('|', 'bbpress-improved-statistics-users-online') . " "  );
            }
            
            return $role_key;
        }
        
        /**
         * Fetch the latest user to register
         * @return array
         * @since 1.3.0
         */
        
        function get_latestuser() {
            $latest_user = get_users(
                array(
                    'number' => 1,
                    'fields' => array("user_login", "ID", "display_name"),
                    'orderby' => "registered",
                    'order' => "DESC"
                )
            );
            
            return reset( $latest_user );
        }
        
        /**
         * Get most users ever online
         * 
         * @since 1.3.0
         * @return array
         */
        
        private function get_mostusers( $count ) {
            
            $record = $this->parent->option['record_users'];
            
            // Update the record if the count of users is bigger than our record
            if( $count > $record['users'] ) {
                
                $record = array(
                    "users" => $count, 
                    "date" => date('Y-m-d H:i:s') 
                );
                
                // Update the record
                update_option( $this->parent->_token . '-' .  "record_users", $record );
            }
            
            // Return the record users            
            return $record;
        }
        
        /**
         * Get the bbPress statistics and remove the keys we don't need
         * @since 1.4.4
         * @return array
         */
        
        function get_bbpress_statistics() {
            // lets get the bbPress stats and define what we need.
            $stats = bbp_get_statistics();            
            $whitelist = array("user_count", "topic_count", "reply_count");
            
            // now lets remove the stats we don't need
            foreach( $stats as $key => $value ) {
                if( !in_array( $key, $whitelist ) ) { 
                    unset( $stats[$key] );
                }
            }
            
            // return the stats minus the stuff we don't need
            return $stats;
        }
                
        /**
         * Gets the correct bbpress statistics.
         * @since 1.4.3
         * @updated 1.4.4
         * @param string $type : formatted or basic stats 
         * @return array
         */
        
        function get_formatted_statistics() {
            
            // Get the bbPress stats, replace commas for calculation
            $stats = $this->get_bbpress_statistics();
            
            // If the site has merge statistics enabled, some additional work is needed before we can return the data
            if( $this->parent->option['bbpress_statistics_merge'] == "on" ) {
                
                $needles = array(',', '.');
                
                // Reverse number_format_i18n
                $stats = str_replace($needles, '', $stats);
                
                // Add the reply and topic counts
                $stats['reply_count'] = ( $stats['reply_count'] + $stats['topic_count'] );
                
                // Re-apply the number formatting
                $stats = array_map( 'number_format_i18n', array_map( 'absint', $stats ) );
            }
            
            // Return the statistics
            return $stats;            
        }
        
        /**
         * Forms the header for each section
         * @param string $title
         * @param string $link
         * @since 1.0.0
         * @return string 
        */
        
        function shortcode_tool_build_title( $title, $link)
        {
            return '<div class="bbpas-header">' . (( $link == false ) ? $title : '<a href="'.$link.'">'.$title.'</a>' ). '</div>';
        }
		
        /**
         * Returns the value of shortcode_activity
         * @since 1.0.2
         */

        function bbpress_hook_get()
        {
            echo '<h2 class="bbpas-h2">' . wp_kses_post( $this->parent->option['before_forum_display'] ) . "</h2>" 
            . $this->shortcode_activity() 
            . wp_kses_post( $this->parent->option['after_forum_display'] ) ;
        }

        /**
         * Hooks the online plugin into various bbPress-defined hooks
         * @since 1.0.2
         */
        function bbpress_hook_display()
        {
                $enabledPoints = $this->parent->option['forum_display_option'];

                // The only hooks we expect to be posted                      
                $allowedFields = array(
                    "bbp_template_after_forums_index", 
                    "bbp_template_after_topics_index", 
                    "bbp_template_after_single_topic", 
                    "bbp_template_after_single_forum"
                );

                if( isset( $enabledPoints ) && $enabledPoints !== "" && $enabledPoints !== false ) {
                    foreach( $enabledPoints as $k => $v )
                    {
                        if( in_array( "bbp_template_" . $v, $allowedFields ) ) {
                            add_action( "bbp_template_" . $v, array($this, "bbpress_hook_get") );
                        }
                    }
                }
        }
}