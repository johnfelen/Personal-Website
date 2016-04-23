<?php
    class PortfolioSort
    {
        function __construct( $sortType, $currSorter )  //$sortType is either NAME, TIME, LANG and $currSorter is either fa-sort-asc or fa-sort-desc
        {
            $this->portfolioDB = new mysqli( "localhost", "root", "jfelen62", "personal website" );
            $this->sortType = $sortType;

            if( $this->portfolioDB->connect_error )
            {
                die( "Error connecting to database" );
            }

            if( $sortType === "NAME" )
            {
                $this->name = $currSorter;
                $this->nextName = $this->getNextHref( $this->name );
                $this->result = $this->queryProjects( $this->name, "Name" );
            }

            else if( $sortType === "TIME" )
            {
                $this->time = $currSorter;
                $this->nextTime = $this->getNextHref( $this->time );
                $this->result = $this->queryProjects( $this->time, "Month Finished" );
            }

            else if( $sortType === "LANG" )
            {
                $this->lang = $currSorter;
                $this->nextLang = $this->getNextHref( $this->lang );
                $this->result = $this->queryProjects( $this->lang, "Programming Languages" );
            }

            $this->setOtherSortButtonVals( $sortType );
        }

        function __destruct()
        {
            mysqli_close( $this->portfolioDB );
        }

        public function getSortButtonVals()  //returns the sort buttons and links to be printed out so they pass the next sort information with GET correctly
        {
            return "
            <ul class=\"nav nav-pills nav-justified\">
                <li class=\"port-padding\"><a href=\"portfolio.php?name={$this->nextName}\">Name of Project <i class=\"fa {$this->name}\"></i></a></i>
                <li class=\"port-padding\"><a href=\"portfolio.php?lang={$this->nextLang}\">Programming Languages <i class=\"fa {$this->lang}\"></i></a></li>
                <li class=\"port-padding\"><a href=\"portfolio.php?time={$this->nextTime}\">Time Finished <i class=\"fa {$this->time}\"></i></a></li>
            </ul>";
        }

        public function getSortedProjects() //return all the projects and their descriptions formatted for the webpage
        {
            $currComparator = "";

            $output = "<hr class=\"color-border\">";
            while( $row = $this->result->fetch_assoc() )
            {
                $newTier = $this->getTierChange( $row, $currComparator );
                $currComparator = $newTier[ 1 ];

                $output .= $newTier[ 0 ];
                $output .= "
                <hr class=\"color-border\">
                <div class=\"row vertical-center\">
                    <div class=\"col-xs-3\">
                        <p class=\"font-title font-large font-center colored-link rotate\" id=\"{$row[ "Name" ]}\">
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

        private function setOtherSortButtonVals( $sortType )    //will set the other variables for the sort buttons to be printed out
        {
            if( $sortType === "NAME" )
            {
                $this->time = "fa-sort";
                $this->nextTime = "fa-sort-asc";
                $this->lang = "fa-sort";
                $this->nextLang = "fa-sort-asc";
            }

            else if( $sortType === "TIME" )
            {
                $this->name = "fa-sort";
                $this->nextName = "fa-sort-asc";
                $this->lang = "fa-sort";
                $this->nextLang = "fa-sort-asc";
            }

            else if( $sortType === "LANG" )
            {
                $this->name = "fa-sort";
                $this->nextName = "fa-sort-asc";
                $this->time = "fa-sort";
                $this->nextTime = "fa-sort-asc";
            }
        }

        private function getTierChange( $row, $currComparator ) //returns a tier change (such as the programming language changes) with the currComparator so the object can keep track of it (witout making it an object variable since it is only used in this method and the method that calls it getSortedProjects())
        {
            $prevComparator = $currComparator;
            if( $this->sortType === "NAME" && $currComparator !== $row[ "Name" ][ 0 ] )
            {
                $currComparator = $row[ "Name" ][ 0 ];
            }

            else if( $this->sortType === "TIME" && $currComparator !== date( "Y", strtotime( $row[ "Month Finished" ] ) ) )
            {
                $currComparator = date( "Y", strtotime( $row[ "Month Finished" ] ) );
            }

            else if( $this->sortType === "LANG" && $currComparator !== $row[ "Programming Languages" ] )
            {
                $currComparator = $row[ "Programming Languages" ];
            }

            if( $prevComparator !== $currComparator )
            {
                return [ "<p class=\"font-title font-header font-center color\">{$currComparator}</p>", $currComparator ];
            }

            else
            {
                return [ "", $currComparator ];
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

        private function queryProjects( $currSortChoice, $orderAttribute )  //query the order of the projects taht will be displayed
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
