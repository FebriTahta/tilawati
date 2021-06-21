/*
Template Name: Qovex - Responsive Bootstrap 4 Admin Dashboard
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Session time 
*/

$.sessionTimeout({
	keepAliveUrl: 'login-status',
	logoutButton:'Logout',
	logoutUrl: 'logout',
	redirUrl: 'logout',
	warnAfter: 3000,
	redirAfter: 30000,
	countdownMessage: 'Redirecting in {timer} seconds.'
});