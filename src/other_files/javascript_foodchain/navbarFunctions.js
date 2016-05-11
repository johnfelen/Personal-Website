//Parse initialize has been removed

var currentUser = Parse.User.current();	//get current user if there

function editLinks()	//changes the link depending on account type
{
	if( currentUser.get("restaurant") )	//user is restaurant, their link should be edit_restaurant_profile and home should be home_restaurant.html
	{
		document.getElementById("edit").href="edit_restaurant_profile.html";
		document.getElementById("home").href="home_restaurant.html";
	}	

	else	//user is a normal user, their link should be edit_user_profile and home should be home_user.html
	{
		document.getElementById("edit").href="edit_user_profile.html";
		document.getElementById("home").href="home_user.html";
	}
}

function logOut()
{
	currentUser.logOut();
	//move user back to login page
}

function greenCog()	//changes the settings cog green
{
	document.getElementById("settings").src="images_foodchain/settings_green.png";
}
	
function whiteCog()	//changes the settings cog white
{
	document.getElementById("settings").src="images_foodchain/settings.png";
}

function greenBell()	//changes the notifications bell green
{
	document.getElementById("notifications").src="images_foodchain/notifications_green.png";
}
	
function whiteBell()	//changes the notifications bell white
{
	document.getElementById("notifications").src="images_foodchain/notifications.png";
}