<?php
require_once("../commonPHP/head.php");
// include("../commonPHP/topNavBarCheck.php"); 
include("../commonPHP/topNavBarLoggedIn.php");
// include("_discover.php");
?>  
<!DOCTYPE html>  
<html lang="en-us"> 


 
<body style="text-align: center; padding: 0; border: 0; margin: 0; background-image: url(../assets/img/MindLOOPS_Resouces/Asset_4.jpg);"> 
  <br>
  <canvas id="unity-canvas" width=1280 height=720 style="width: 1280px; height: 720px; background: #231F20"></canvas>
  <script src="Build/Munch.loader.js"></script>
  <script>
    if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
      // Mobile device style: fill the whole browser client area with the game canvas:
      var meta = document.createElement('meta');
      meta.name = 'viewport';
      meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
      document.getElementsByTagName('head')[0].appendChild(meta);

      var canvas = document.querySelector("#unity-canvas");
      canvas.style.width = "100%";
      canvas.style.height = "100%";
      canvas.style.position = "fixed";

      document.body.style.textAlign = "left";
    }

    createUnityInstance(document.querySelector("#unity-canvas"), {
      dataUrl: "Build/Munch.data",
      frameworkUrl: "Build/Munch.framework.js",
      codeUrl: "Build/Munch.wasm",
      streamingAssetsUrl: "StreamingAssets",
      companyName: "DefaultCompany",
      productName: "MindLoops Munch",
      productVersion: "1.0",
      // matchWebGLToCanvasSize: false, // Uncomment this to separately control WebGL canvas render size and DOM element size.
      // devicePixelRatio: 1, // Uncomment this to override low DPI rendering on high DPI displays.
    });
  </script>
</body>

</html>
