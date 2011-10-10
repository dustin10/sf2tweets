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
        var tweetHtml = $('.tweet-prototype').first().html();
        tweetHtml = tweetHtml.replace(/{screen_name}/g, data.twitter_user_screen_name);
        tweetHtml = tweetHtml.replace(/{avatar_url}/g, data.twitter_user_avatar_url);
        tweetHtml = tweetHtml.replace(/{message}/g, data.formatted_message);
        tweetHtml = tweetHtml.replace(/{id}/g, data.twitter_id);
        
        // add the element
        $('.sidebar-inner').prepend(tweetHtml);
        
        // add icon to map if valid coords
        if (data.latitude != 0 && data.longitude != 0) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(data.latitude, data.longitude),
                map: tweetMap,
                icon: '/bundles/vichsf2tweets/images/map-icon.png'
            });
            
            // create tweet marker info window
            var windowHtml = $('.info-window-prototype').first().html();
            windowHtml = windowHtml.replace(/{screen_name}/g, data.twitter_user_screen_name);
            windowHtml = windowHtml.replace(/{message}/g, data.formatted_message);
            windowHtml = windowHtml.replace(/{id}/g, data.twitter_id);
            
            var infoWindow = new google.maps.InfoWindow({content: windowHtml});
            google.maps.event.addListener(marker, "click", function (e) {
                infoWindow.open (tweetMap, marker);
            });
            
            // add the marker to the bounds and fit
            tweetMapBounds.extend(new google.maps.LatLng(data.latitude, data.longitude));
            tweetMap.fitBounds(tweetMapBounds);
        }
    });
   
});