var lines = [ "Hello there! Welcome to the world of Earth!",
"My name is John Felen! People call me John!",
"This world is inhabited by creatures called humans!",
"For some people, humans are pets. Other use them for fights.",
"Myself...",
"I study humans as profession.",
"First, what is your name?" ];
var count = 0;
var currentlyTyping = false;    //used to stop repeat clicking which will cause gibberish to type out

function printNextLine()
{
    if( count < lines.length && !currentlyTyping )
    {
        var chars = lines[ count ].split("");
        /*The below function is based on the last response in http://stackoverflow.com/questions/23688149/simulate-the-look-of-typing-not-the-actual-keypresses-in-javascript
        I tried other ways by myself first and then stubbled upon setTimeout, however I did not know you had to use recursion until I read the above response*/
        var currentCharIndex = 0;
        function printNextChar()
        {
            if( currentCharIndex == chars.length )
            {
                document.getElementById( "pokemon" ).innerHTML =  document.getElementById( "pokemon" ).innerHTML + "<br>";
                count++;
                currentlyTyping = false;
                return;
            }
            
            document.getElementById( "pokemon" ).innerHTML =  document.getElementById( "pokemon" ).innerHTML + chars[ currentCharIndex ];
            currentCharIndex++;
            setTimeout( printNextChar, 40 );
        }
        
        currentlyTyping = true;
        printNextChar();
    }
}



function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}