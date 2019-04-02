    <footer class="footer" style="background: linear-gradient(90deg,#ff3636 0,#ffb236 60%,#f96332);">
      <div class="container-fluid">
        <div class="copyright" id="copyright">
          &copy;<?=date("Y");?> All Rights Reserved <a href="" class="text-white">Care India</a>. Developed by <a href="mailto:ajaykiet2@gmail.com" class="text-white">Ajay Kumar</a>
        </div>
      </div>
    </footer>
  </div>
</div>
<div class="loader-overlay">
	<div class="loader"></div>
</div>
<script> 
  $(document).ready(()=>{
    ServiceWorker.init();
    $(".loader-overlay").hide();
  });
</script>
</body>
</html>
