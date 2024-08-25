<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
</head>

<body>

   <script>
       var post_id = {{ $post_id }};
       var fallbackToStore = function() {
          window.location.replace('market://details?id=com.ordrz.app');
        };
        var openApp = function() {
          window.location.replace('ordrz://posts/'+post_id); // Replace your_uri_scheme with the one you added in the manifest
        };
        var triggerAppOpen = function() {
          openApp();
          setTimeout(fallbackToStore, 250);
        };

       triggerAppOpen();
   </script>
</body>

</html>
