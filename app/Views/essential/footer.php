<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>


<script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

  var sidebar = document.getElementById("dashboardNavbar")
  var content = document.getElementById("dashboardContent")


  var sidebarIsOn
  if (window.innerWidth < 576) {
    sidebarIsOn = true
  } else {
    sidebarIsOn = false
  }

  // console.log(sidebarIsOn)

  if (sidebarIsOn == true) {
    sidebar.style.transform = "translateX(-100%)"
    content.style.marginLeft = "0"
  } else {
    sidebar.style.transform = "translateX(0)"
    content.style.marginLeft = "300px"
  }

  // mySidebar();

  function mySidebar() {
    if (sidebarIsOn == true) {
      sidebar.style.transform = "translateX(0)"
      content.style.marginLeft = "300px"
      sidebarIsOn = false
    } else {
      sidebar.style.transform = "translateX(-100%)"
      content.style.marginLeft = "0"

      sidebarIsOn = true
    }
  }
</script>