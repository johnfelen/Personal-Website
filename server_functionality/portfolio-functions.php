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

            if( isset( $_GET[ "name" ] ) )  //sort by NAME and set the variables for sorting buttons
            {
                $name = $_GET[ "name" ];
                $this->result = $this->queryProjects( $name, "Name" );
                $this->currComparator = "z";
                $this->sortType = "NAME";
                $nextName = $this->getNextHref( $name );
                $time = "fa-sort";
                $nextTime = "fa-sort-asc";
            }

            else if( isset( $_GET[ "time" ] ) ) //sort by TIME and set the variables for sorting buttons
            {
                $time = $_GET[ "time" ];
                $this->result = $this->queryProjects( $time, "Month Finished" );
                $this->currComparator = "0";
                $this->sortType = "YEAR";
                $name = "fa-sort";
                $nextName = "fa-sort-asc";
                $nextTime = $this->getNextHref( $time );
            }
        }

        function __destruct()
        {
            mysqli_close( $this->portfolioDB );
        }

        public function setFunction( $compare )
        {
            $this->currComparator = $compare;
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

        private function getTierChange( $row ) //checks if the next item would be in a different "tier" and prints it out if it is, such as when the year changes or the starting letter of the project changes print out the change
        {
            if( $this->sortType === "NAME" && $this->currComparator !== $row[ "Name" ][ 0 ] )
            {
                $this->currComparator = $row[ "Name" ][ 0 ];
                return "<p class=\"font-title font-header font-center color\">{$this->currComparator}</p>";
            }

            else if( $this->sortType === "YEAR" && $this->currComparator !== date( "Y", strtotime( $row[ "Month Finished" ] ) ) )
            {
                $this->currComparator = date( "Y", strtotime( $row[ "Month Finished" ] ) );
                return "<p class=\"font-title font-header font-center color\">{$this->currComparator}</p>";
            }

            else
            {
                return "";
            }
        }

        private function getNextHref( $currHref )   //will figure out which attribute will be passed through $_GET[] for each sort button
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
    }
?>
