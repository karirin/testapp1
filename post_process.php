<div class="modal modal_close"></div>
<div class="post_process">
  <h2>投稿</h2>
  <form method="post" action="../post/post_add_done.php" enctype="multipart/form-data">
  <textarea class="textarea form-control" placeholder="投稿内容を入力ください" name="text"></textarea>
  <div class="counter">
                <span class="show_count">0</span><span>/300</span>
  </div>
  画像を選んでください。
  <input type="file" name="gazou_name" style="width:200px">
  <button class="btn btn-outline-danger" type="submit" name="post" value="post" id="post">投稿</button>
  <button class="btn btn-outline-primary modal_close" type="button">キャンセル</button>
  </form>
</div>