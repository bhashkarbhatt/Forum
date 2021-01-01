<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Welcome to iDiscuss - Coding forum</title>
    <style>
    #ques {
        min-height: 433px;
    }
    </style>

</head>

<body>
    <?php include 'partial/header.php';  ?>
    <?php include 'partial/dbconnect.php';  ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id"; 
    $result = mysqli_query($conn, $sql);  
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
         $desc = $row['thread_desc'];

        
    }  
    ?>


    
<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // insert comment into database
        $comment = $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
        VALUES ('$comment', '$id', '0', current_timestamp());
        ;"; 
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been  added ! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } 
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something went wrong.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

    }    
    
    ?>




    <div class="container my-3" id="ques">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge to each others.
                No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Remain respectful of other members at all times.
            </p>
            <p>Posted by:<b>Bhashkar</b></p>
        </div>
    </div>

<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<div class="container">
         <div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <form action="'.$_SERVER['REQUEST_URI'].' ?>" method="POST">
                <!-- <div class="form-group">
                <label for="title">Thread Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title short and crisp as possible.</small>
            </div> -->
                <div class="form-group">
                    <label for="comment">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>';
    }
        ?>
        <h1 class="py-2">Discussions</h1>
        
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id"; 
            $result = mysqli_query($conn, $sql);  
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                echo '<div class="media my-3">
                <img src="img/user_default_img.png" width=60px; class="mr-3" alt="...">
                <div class="media-body my-3">
                <p class="font-weight-bold my-0">Anonymous User at '.$comment_time.'</p> 
                   '. $content .'
                  </div>
                 </div>';
    } 
    // echo var_dump($noResult);
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Threads Found</p>
                    <p class="lead">Be the first person to ask a question.</p>
                </div>
                </div>';
       
    }  
    ?> 

    </div>



    <?php include 'partial/footer.php';  ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>