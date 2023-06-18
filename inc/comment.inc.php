<?php
include_once './dbh.inc.php';
include_once './Auth/auth.php';
include_once './extra/notification.class.php';

$notify = new Notification();
session_start();

if (isset($_POST['id'])) {
    $comment = $_POST['comment'];
    if (empty($comment)) {
        die(json_encode(array('status' => 'error', 'message' => 'Comment cannot be empty')));
    }
    $post = $_POST['id'];
    $user = $_POST['user'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;

    // Retrieve the user's token
    $sql = "SELECT `idusers` FROM `users` WHERE `uidusers`='$user'";
    $token = $un_ravel->_queryUser(((mysqli_fetch_assoc($conn->query($sql)))['idusers']), 1);

    // Insert the comment into the database
    $sql = "INSERT INTO `comments`(`post_id`, `user`, `user_token`, `comment`, `parent_id`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $post, $user, $token, $comment, $parent_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->close();

    if ($user != $_SESSION['userId']) {
        $user_name = $un_ravel->_username($_SESSION['userId']);
        $text = "$user_name just <a href='post.php?id=$post'>commented on your post</a>";
        $notify->notify($user, $text, 'post');
    }

    print_r(json_encode('commented'));
}

// Delete comment if it is the user's comment
if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $sql = "SELECT `user` FROM `comments` WHERE `id`='$comment_id'";
    $user = (mysqli_fetch_assoc($conn->query($sql)))['user'];
    if ($user == $_SESSION['userUid']) {
        $sql = "DELETE FROM `comments` WHERE `id`='$comment_id'";
        $conn->query($sql);
        print_r(json_encode('deleted'));
    }
}
