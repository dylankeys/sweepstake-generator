<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sweepstake</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar sticky-top bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">Sweepstake</a>
        <form class="d-flex" role="search">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Restart draw</a>
            </li>
          </ul>
        </form>
      </div>
    </nav>
    <div class="container" style="padding-top:20px">
    
    <form class="row g-3" method="POST" action="index.php">
    <?php
      // Configure sweepstake options here
      $sweep_opts = array('Qatar', 'Netherlands', 'Senegal', 'Ecuador', 'England', 'USA', 'Wales', 'Iran', 'Argentina', 'Poland', 'Mexico', 'Saudi Arabia', 'France', 'Denmark', 'Tunisia', 'Australia', 'Germany', 'Spain', 'Japan', 'Costa Rica', 'Belgium', 'Croatia', 'Canada', 'Morocco', 'Brazil', 'Switzerland', 'Serbia', 'Cameroon', 'Portugal', 'Uruguay', 'Ghana', 'Korea Republic');
      
      $sweep_opts_number = count($sweep_opts);

      if(!isset($_POST['participantsnum']) && !isset($_POST['participants'])) {
      echo '<div class="mb-3">
              <label for="participantsnum" class="form-label">Number of participants</label>
              <input type="number" class="form-control" id="participantsnum" name="participantsnum" required>
            </div>';

      echo '<button type="submit" class="btn btn-primary">Next ></button>';
      }

      
      if(isset($_POST['participantsnum'])) {
        $participants_num = $_POST['participantsnum'];
       
        for($x = 1; $x <= $participants_num; $x++) {
          echo '<div class="col-md-4">
                  <label for="participants" class="form-label">Participant #'.$x.'</label>
                  <input type="text" class="form-control" id="participants" name="participants[]" required>
                </div>';
        }
        echo '<button type="submit" class="btn btn-primary">Next ></button>';
      }

      if(isset($_POST['participants'])) {
        $participants = $_POST['participants'];
        $participants_number = count($participants);
        
        $max_opts_per_person = $sweep_opts_number / $participants_number;

        if ($max_opts_per_person < 1) {
          echo '<p>ERROR: Too many participants. Less than one option per participant available.</p>';
        }
        else {
          $opts_per_person = (int) $max_opts_per_person;
          echo '<p>Options per person: '.$opts_per_person.'</p>';
          
          for ($x = 0; $x < $opts_per_person; $x++) {
            foreach ($participants as $participant) {
              $sweep_opts_random = array_rand($sweep_opts);
              
              $results[$participant] .= ' | ' . $sweep_opts[$sweep_opts_random];
  
              unset($sweep_opts[$sweep_opts_random]);
            }
          }
          
          
          echo '<div class="row">';
          echo '<div class="col">';
          echo '<h2>Final draw</h2>';

          foreach($results as $person => $opts) { 
            echo '<p><strong>'.$person.'</strong> '.$opts.'</p>';
          }

          echo '</div>';
          echo '<div class="col">';
          echo '<h2>Remaining teams</h2>';

          foreach($sweep_opts as $sweep_opt) { 
            echo '<p>'.$sweep_opt.'</p>';
          }

          echo '</div>';
          echo '<p>&nbsp;</p>';
          echo '<p>Refresh page to re-run draw.</p>';
        }

      }
      ?>
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>