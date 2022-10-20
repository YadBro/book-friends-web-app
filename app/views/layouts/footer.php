</div>
</div>

</div>

<!-- BOOTSTRAP BUNDLE JS -->
<script src="<?= BASE_URL; ?>bootstrap_5/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
  let el = document.getElementById("wrapper");
  var toggleButton = document.getElementById("menu-toggle");

  toggleButton.onclick = function() {
    el.classList.toggle("toggled");
  }
</script>
</body>

</html>