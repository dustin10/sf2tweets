$(function() {
    
    var timeoutId = null;
    
    var socket = io.connect('http://localhost:9999');
    socket.on('tweet_received', function(data) {
        if (null !== timeoutId) {
            clearTimeout(timeoutId);
            timeoutId = null;
        }
        
        // fade in the notification
        $(".new-tweet").hide().fadeIn(500, function() {
            timeoutId = setTimeout(function() {
                $(".new-tweet").fadeOut(500);
            }, 3000);
        });
        
        // create the new tweet html from the prototype
        var tweetEl = $('.sidebar-inner').prepend($('.tweet-prototype').first().html()).find('div.tweet').first();
        tweetEl.find('a.tweet-avatar').attr('href', 'http://www.twitter.com/' + data.twitter_user_screen_name).attr('alt', data.twitter_user_screen_name).attr('title', data.twitter_user_screen_name);
        tweetEl.find('img').attr('src', data.twitter_user_avatar_url);
        tweetEl.find('a.tweet-username').attr('href', 'http://www.twitter.com/' + data.twitter_user_screen_name).html('@' + data.twitter_user_screen_name);
        tweetEl.find('p.tweet-message').html(data.formatted_message);
        tweetEl.find('a.tweet-view').attr('href', 'http://www.twitter.com/' + data.twitter_user_screen_name + '/status/' + data.twitter_id);
        
        // add icon to map if valid coords
        if (data.latitude != 0 && data.longitude != 0) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(data.latitude, data.longitude),
                map: tweetMap,
                icon: '/bundles/vichsf2tweets/images/map-icon.png'
            });
            
            // create tweet marker info window
            var windowEl = $('.info-window-prototype').first().clone();
            windowEl.find('p.tweet-message').html(data.formatted_message);
            windowEl.find('a.tweet-view').attr('href', 'http://www.twitter.com/' + data.twitter_user_screen_name + '/status/' + data.twitter_id);
            
            var infoWindow = new google.maps.InfoWindow({content: windowEl.html()});
            google.maps.event.addListener(marker, "click", function (e) {
                infoWindow.open (tweetMap, marker);
            });
            
            // add the marker to the bounds and fit
            tweetMapBounds.extend(new google.maps.LatLng(data.latitude, data.longitude));
            tweetMap.fitBounds(tweetMapBounds);
        }
    });
   
});