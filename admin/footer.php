
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/adminlte.min.js"></script>
<script src="public/tinymce/tinymce.min.js"></script>
<script src="public/tinymce/config.js"></script>
<script type="text/javascript">
  $('input#select_img').change(function(){
    var file = $('input#select_img').prop('files');
    if (file && file[0]) {
      var reader = new FileReader();

      reader.onload = function(e){
        // console.log(e.target.result);
        $('img#show_img').attr('src',e.target.result);
      }

      reader.readAsDataURL(file[0]);
    }
  });
</script>
</body>
</html>
