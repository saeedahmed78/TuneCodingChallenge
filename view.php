<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="./assets/js/script.js"></script>
    <title>TEST | Chart</title>
</head>

<body>

    <header>
        <nav>
            <div class="hamburger" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <a href="javascript:void(0)" class="user-name">
                User Dashboard
            </a>
        </nav>
        <div class="search">
            <div class="input-wrapper">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M13.1396 13.2353C15.6543 10.7021 15.6543 6.59515 13.1396 4.06201C10.6247 1.52888 6.54744 1.52888 4.03263 4.06201C1.51782 6.59515 1.51782 10.7021 4.03263 13.2353C6.54744 15.7684 10.6247 15.7684 13.1396 13.2353ZM14.6574 14.7642C18.0105 11.3867 18.0105 5.91064 14.6574 2.53314C11.3043 -0.844378 5.86789 -0.844378 2.51481 2.53314C-0.838269 5.91064 -0.838269 11.3867 2.51481 14.7642C5.86789 18.1417 11.3043 18.1417 14.6574 14.7642Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M13.8986 13.9998C14.3177 13.5776 14.9973 13.5776 15.4164 13.9998L19.2109 17.8219C19.6301 18.2441 19.6301 18.9286 19.2109 19.3508C18.7918 19.7729 18.1122 19.7729 17.6931 19.3508L13.8986 15.5286C13.4795 15.1065 13.4795 14.4219 13.8986 13.9998Z"
                            fill="white" />
                    </svg>
                </div> 
                <input type="text" id="search" placeholder="search..." onkeyup="searchUser()">
            </div>
        </div>
    </header>
    <main>
        <section class="crad-wrapper">
            <div class="custom-container">
                <select id="sorting" class="form-control" onchange="sorting(this)">
                    <option value="name_asc" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_asc')?'selected':'';?>>Name Asc</option>
                    <option value="name_desc" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_desc')?'selected':'';?>>Name Desc</option>
                    <option value="revenue_asc" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'revenue_asc')?'selected':'';?>>Revenue Asc</option>
                    <option value="revenue_desc" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'revenue_desc')?'selected':'';?>>Revenue Desc</option>
                </select>
                <div class="row">
                    <?php foreach($user_list as $user){ //print_r($user); ?>
                    <div class="col-md-4 pd-0">
                        <div class="card shadow-sm p-3 bg-white rounded">
                            <div class="card-body">
                                <div class="avatar">
                                    <div class="user-img">
                                        <img src="assets/images/avatar.png" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="card-title user"><?php echo $user['users']['name']; ?></h4>
                                        <h6 class="card-subtitle mb-2 text-muted desination"><?php echo $user['users']['occupation']; ?></h6>
                                    </div>
                                </div>
                                <div class="wrapper">
                                    <div class="chart-wrapper">
                                        <div class="chart" id="chartDiv" style="width: 100%; height: auto;"></div>
                                        <canvas id="<?php echo $user['users']['id']; ?>"></canvas>
                                        <script>createGraph(<?php echo $user['users']['id'] .','. json_encode($user['users']['logs']['day_conversion']); ?>)</script>
                                    </div>
                                    <div class="chart-content">
                                        <div class="content-center-wrapper">
                                            <div class="conversion-num font-weight-bold"><?php echo $user['users']['logs']['total_conversion']; ?></div>
                                            <div class="conversion">conversion</div>
                                        </div>
                                        <div class="content-left-wrapper">
                                            <div class="impression-num font-weight-bold"><?php echo $user['users']['logs']['total_impression']; ?></div>
                                            <div class="impression text-muted">impression</div>
                                        </div>
                                        <div class="content-left-wrapper">
                                            <div class="revnue-num font-weight-bold">
                                                $<?php echo ($user['users']['logs']['total_conversion']+$user['users']['logs']['total_impression'] ); ?>
                                            </div>
                                            <div class="revnue">revnue</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                
                </div>
            </div>
        </section>

    </main>

    <footer></footer>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- <script src="https://code.jscharting.com/latest/jscharting.js"></script> -->

</body>

</html>