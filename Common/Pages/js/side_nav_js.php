<script>
//   new SimpleBar(document.getElementById('sideNavigation'));

  // Get all sidebar links with collapse behavior
  const sidebarLinks = document.querySelectorAll('.sidebar-link[data-bs-toggle="collapse"]');

  // Add click event listener to each sidebar link
  sidebarLinks.forEach(link => {
    link.addEventListener('click', () => {
      const targetId = link.getAttribute('href');

      // Collapse all menus
      sidebarLinks.forEach(otherLink => {
        const otherTargetId = otherLink.getAttribute('href');
        if (otherTargetId !== targetId) {
          const otherMenu = document.querySelector(otherTargetId);
          if (otherMenu.classList.contains('show')) {
            otherLink.click();
          }
        }
      });
    });
  });
</script>