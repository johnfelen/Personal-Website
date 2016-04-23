<?php
    class PortfolioSort
    {
        function __construct()
        {
            $this->portfolioDB = new mysqli( "localhost", "root", "jfelen62", "personal website" );

            if( $this->portfolioDB->connect_error )
            {
                die( "Error connecting to database" );
            }

            $this->updateSortingFunctions();
        }

        function __destruct()
        {
            mysqli_close( $this->portfolioDB );
        }

        public function setFunction( $compare )
        {
            $this->currComparator = $compare;
        }

        public function getSortButtonVals( $type )  //returns data so that the sort buttons and GET links are correct for in the HTML
        {
            if( $type === "name" )
            {
                return [ $this->name, $this->nextName ];
            }

            else if( $type === "time" )
            {
                return [ $this->time, $this->nextTime ];
            }

            else if( $type === "lang" )
            {
                return [ $this->lang, $this->nextLang ];
            }
        }

        public function getSortedProjects() //return all the projects and their descriptions formatted for the webpage
        {
            $output = "<hr class=\"color-border\">";
            while( $row = $this->result->fetch_assoc() )
            {
                $output .= $this->getTierChange( $row );
                $output .= "
                <hr class=\"color-border\">
                <div class=\"row vertical-center\">
                    <div class=\"col-xs-3\">
                        <p class=\"font-title font-large font-center colored-link rotate\">
                            <a href=\"{$row[ "Link" ]}\" title=\"{$row[ "Link" ]}\" target=\"_blank\">{$row[ "Name" ]}</a>
                        </p>
                    </div>

                    <div class=\"col-xs-9\">
                        <p class=\"font-main font-center font-small color\">{$row[ "Description" ]}</p>
                    </div>
                </div>
                <hr class=\"color-border\">";
            }
            $output .= "<hr class=\"color-border\">";

            return $output;
        }

        private function getTierChange( $row ) //checks if the next item would be in a different "tier" and prints it out if it is, such as when the year changes return a HTML string to be printed out to the screen
        {
            $prevComparator = $this->currComparator;
            if( $this->sortType === "NAME" && $this->currComparator !== $row[ "Name" ][ 0 ] )
            {
                $this->currComparator = $row[ "Name" ][ 0 ];
            }

            else if( $this->sortType === "YEAR" && $this->currComparator !== date( "Y", strtotime( $row[ "Month Finished" ] ) ) )
            {
                $this->currComparator = date( "Y", strtotime( $row[ "Month Finished" ] ) );
            }

            else if( $this->sortType === "LANG" && $this->currComparator !== $row[ "Programming Languages" ] )
            {
                $this->currComparator = $row[ "Programming Languages" ];
            }

            if( $prevComparator !== $this->currComparator )
            {
                return "<p class=\"font-title font-header font-center color\">{$this->currComparator}</p>";
            }

            else
            {
                return "";
            }
        }

        private function getNextHref( $currHref )   //figures out which sorting button should be printed out
        {
            if( $currHref === "fa-sort" )
            {
                return "fa-sort-asc";
            }

            else if( $currHref === "fa-sort-asc" )
            {
                return "fa-sort-desc";
            }

            else
            {
                return "fa-sort-asc";
            }
        }

        private function queryProjects( $currSortChoice, $orderAttribute )  //query the order the projects will be displayed
        {
            if( $currSortChoice === "fa-sort-asc" )
            {
                $result = $this->portfolioDB->query( "SELECT * FROM `project descriptions` ORDER BY `{$orderAttribute}` ASC" );
            }

            else if( $currSortChoice === "fa-sort-desc" )
            {
                $result = $this->portfolioDB->query( "SELECT * FROM `project descriptions` ORDER BY `{$orderAttribute}` DESC" );
            }

            if( !$result )
            {
                die( "Error with query" );
            }

            else
            {
                return $result;
            }
        }

        private function updateSortingFunctions()
        {
            if( isset( $_GET[ "name" ] ) )  //sort by NAME and set the variables for sorting buttons
            {
                $this->name = $_GET[ "name" ];
                $this->result = $this->queryProjects( $this->name, "Name" );
                $this->currComparator = "";
                $this->sortType = "NAME";
                $this->time = "fa-sort";
                $this->nextTime = "fa-sort-asc";
                $this->lang = "fa-sort";
                $this->nextLang = "fa-sort-asc";
                $this->nextName = $this->getNextHref( $this->name );
            }

            else if( isset( $_GET[ "time" ] ) ) //sort by TIME and set the variables for sorting buttons
            {
                $this->time = $_GET[ "time" ];
                $this->result = $this->queryProjects( $this->time, "Month Finished" );
                $this->currComparator = "";
                $this->sortType = "YEAR";
                $this->name = "fa-sort";
                $this->nextName = "fa-sort-asc";
                $this->lang = "fa-sort";
                $this->nextLang = "fa-sort-asc";
                $this->nextTime = $this->getNextHref( $this->time );
            }

            else if( isset( $_GET[ "lang" ] ) )
            {
                $this->lang = $_GET[ "lang" ];
                $this->result = $this->queryProjects( $this->lang, "Programming Languages" );
                $this->currComparator = "";
                $this->sortType = "LANG";
                $this->name = "fa-sort";
                $this->nextName = "fa-sort-asc";
                $this->time = "fa-sort";
                $this->nextTime = "fa-sort-asc";
                $this->nextLang = $this->getNextHref( $this->lang );
            }
        }
    }
?>
