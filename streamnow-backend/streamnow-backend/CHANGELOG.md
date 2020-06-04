# Changelog

All notable changes to this project will be documented in this file.

##[1.2.1]

### Fixed

	- API - redeem minimum amount - send request issue 

## [1.0.0] - 2015-12-03

### Fixed

- 66da49d Social login - cancel button error fixed


2017-04-07 : Email Features Added for user

2017-04-17 : API Youtube link issue fixed - Refer Commit ID -  4697c37

## [Unreleased]

## [1.2.0] - 2017-11-01

### Fixed

- Twitter login issue fixed.

### Added 

2017-10-23 - dotenv config in package.json. To get env values. Refer Commit ID - 7bd9254

2017-10-23 - Close streaming function added in disconnect socket. Refer Commit ID - 7bd9254

2017-10-23 - Cronjob function for payment notification. Every Midnight it will run. Refer Commit ID - 7bd9254

2017-10-23 - Cronjob function to close all the exists streaming videos based on admin given time. Refer Commit ID - 7bd9254

2017-10-23 - Send Payment Remainder for every users before 10 days. Refer Commit ID - 7bd9254

### Changed

2017-10-23 - Chat Socket url Settings changed angular into admin panel. Note : Exists in Admin -> Settings ->  Other Settings - Refer commit ID - 10ae928


### Fixed

2017-10-23 - Close the streaming video automatically, when following cases execute, Refer Commit ID - 7bd9254

        a) Tap / Browser closed by the user,

        b) shutdown the system by user / automatic power off.

        c) User Navigate one option to another option.

2017-10-23 - Without Kurento, the live streaming function execute in firefox, Chrome using Peer To Peer Connection. Refer Commit ID - 7bd9254

2017-10-23 - User Subscription date expired, again user has to subscribe. Refer Commit ID - 7bd9254

## 14.12.2016

- Change password - On entering the current password wrong - Showed proper message Instead of "Please match the requested format"

- Change password -  Changed cancel button into Reset Button

- Delete Account -  Changed cancel button into Reset Button

- Footer My Account - Should take to Profile page - the issue fixed. In Profile page, you cant see the my aacount in footer, other pages you can see the account

- Fixed - Search results show randomly all profiles and not the one searched - If that's not available - It should show "Search results not found" and then below the random profiles for user to look through 

- Profile page - Followers & folliwngs profile given profile link if they click on image

- Displayed favicon in admin panel

- Update Profile -> changed heading and removed top space

- On Broadcast , Getting warning toast (Datetime issue) fixed

- Maintained status for streaming - Video Call Initiated, Video Call Ended and Video call started

- Page counter issue fixed

## 20.12.2017

- Admin panel - Added Revenue System Option under Payments

## 21.12.2017

- User panel, Added Subscribed plans info

- User Panel, Added Paid videos info

- User panel, Added Redeem request option with cancel option

- User panel, Added Streamed videos info by logged in user.

- Admin panel -> Added Redeem option - He can pay back to the user.


## 09.12.2017

- Admin panel - Added - Revenue Dashboard done

- Added Paypal email id for users as well as admin panel.

- Admin panel - Removed mobile number field from user creation 

- Admin panel - Added User followers list

- Admin panel - Added User followings list

- Broadcasting issues fixed.


## 26.12.2017

- Admin Panel - Users, added status of log-in. Whether the user currently logged in or not

- Admin Panel - Users, added clear login - Manually admin can clear the login of user.

- Admin Panel - Settings -> Other settings - Token Expiry hour given.

- User panel - UI was changed (Background color, loader and etc)

- User panel - In profile page, Blocked users list displayed with Unblock option

- User panel - If the user blocked any one of the user, Both of them won't get any notification. Example : In search they won't appear, live streaming videos wont display and etc.

- Live Streaming support in safari. Streaming By safari, and you can view by all other browsers.

- User panel - User having only one account, so they can login only one device.

## 28.04.2018

- User side - Changed Timer functions in client side into Socket connection.

- User Panel - Removed kurento & Wowza

- Implemented "WEBRTC" for all the browsers (WEB/MOBILE)

- Admin Panel - Coupon code added

- Admin Panel - Email Template issue fixed.
