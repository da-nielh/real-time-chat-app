<div class="iframe-container">
  <iframe id="contentFrame" src="https://www.example.com"></iframe>
</div>
<script src="javascript/message.js"></script>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iframe Navigation</title>
    <style>
      body {
        display: flex;
      }
      .links {
        width: 30%;
        padding: 10px;
      }
      .iframe-container {
        width: 70%;
      }
      iframe {
        width: 100%;
        height: 100vh;
        border: none;
      }
    </style>
  </head>
  <body>
    <div class="links">
      <ul>
        <li><a href="#" data-url="https://www.example.com">Example</a></li>
        <li><a href="#" data-url="https://www.google.com">Google</a></li>
        <li><a href="#" data-url="https://www.wikipedia.org">Wikipedia</a></li>
      </ul>
    </div>
    <div class="iframe-container">
      <iframe id="contentFrame" src="https://www.example.com"></iframe>
    </div>

    <script>
      document.querySelectorAll(".links a").forEach((link) => {
        link.addEventListener("click", function (event) {
          event.preventDefault();
          const url = this.getAttribute("data-url");
          document.getElementById("contentFrame").setAttribute("src", url);
        });
      });
    </script>
  </body>
</html>
