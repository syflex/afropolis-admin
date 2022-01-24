<head>
    <!-- Styles -->
    <style>
                html, body {
                    background-color: #fff;
                    color: #636b6f;
                    font-family: 'Raleway', sans-serif;
                    font-weight: 100;
                    height: 100vh;
                    margin: 0;
                }

                .row {
                    width: 100%;
                }

                .flex-center {
                    align-items: center;
                    display: flex;
                    justify-content: center;
                }

                .content {
                    text-align: center;
                }

                .title {
                    font-size: 32px;
                }

                .links > a {
                    color: #FFF;
                    padding: 0 8px;
                    font-size: 12px;
                    /* font-weight: 600; */
                    /* letter-spacing: .1rem; */
                    text-decoration: none;
                    /* text-transform: uppercase; */
                }

                .text-white {
                    color: #FFF;
                }

                .back-pad {
                    background-color: #006400; padding: 10px 10px 10px 10px;
                }
            </style>
        </head>
    <body>
    <div class="flex-center back-pad">
        <div class="title content row">
            <b class="text-white content">Afropolis</b>
        </div>
    </div>

    <p style="font-size: 18px"><b>Hi {{$user['name']}}</b></p>
    <p style="font-size: 20px"><b>Welcome to afropolis</b></p>
    <p>
        We are excited to have you join this global platform.
    </p>
    <p>Qhodus <br>
    (Founder, Afropolis)
    </p>

    <div class="flex-center back-pad">
        <div class="content links row">
            <a href="#">Login</a>|
            <a href="#">About Us</a>|
            <a href="#">Contact Us</a>
        </div>
    </div>

    <p class="content" style="font-size: 8px;">Copyright (c) 2022 afropolis.</p>

    </body>
