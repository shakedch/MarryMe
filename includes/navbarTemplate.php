<nav class="navbar navbar-expand-lg navbar-light fixed-top px-2" style="
    height: inherit;
">

    <a class="navbar-brand" href="../../index.php" style="display: flex;justify-content: center;align-items: center;">
        <img width="35px" src="../../assets/img/tab_logo.png" alt="logo" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-black" href="../../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo $where0 ?>"><?php echo $one_n ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo $where3 ?>"><?php echo $sec_n ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo $where4 ?>"><?php echo $thr_n ?></a>
            </li>
        </ul>

        <div class="mx-auto"></div>
        <?php
        if ($role == 'couple') {
            echo "<span class='navbar-text text-black'>$user->full_name1  &
        $user->full_name2</span>";
        } else {
            echo "<span class='navbar-text text-black'> $vendor->company_name</span>";
        } ?>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-primary" href="<?php echo $where1 ?>"><?php echo $inout ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary" href="<?php echo $where2 ?>"><?php echo $SeeCre ?></a>
            </li>
        </ul>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
</nav>