# SmartPush
Api of test for push notification Android &amp; IOS

Send push notification to APNS and Google

# Usage example:
Make a request POST with fields:

  
  #IOS
  * type => 'ios'
  * deviceToken
  * badge => int optional
  * msg

  #ANDROID
  * type => 'android'
  * deviceToken
  * title
  * subtitle
  * msg
  * tickerText (optional)
