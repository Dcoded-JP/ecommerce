

document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.getElementById('menuToggle');
  const sidebarClose = document.getElementById('sidebarClose');
  const toggleIcon = document.getElementById('toggleIcon');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const content = document.querySelector('.content');
  const header = document.querySelector('.header');
  const footer = document.querySelector('.footer');

  function toggleSidebar() {
    sidebar.classList.toggle('show');
    content.classList.toggle('shifted');
    header.classList.toggle('shifted');
    footer.classList.toggle('shifted');

    // Toggle overlay only on mobile
    if (window.innerWidth < 768) {
      overlay.classList.toggle('show');
      document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : 'auto';
    }

    // Toggle hamburger icon
    toggleIcon.classList.toggle('fa-bars');
    // toggleIcon.classList.toggle('fa-times');
  }

  // Set up event listeners
  menuToggle.addEventListener('click', toggleSidebar);
  sidebarClose.addEventListener('click', toggleSidebar);
  overlay.addEventListener('click', toggleSidebar);

  // Close sidebar when clicking outside
  document.addEventListener('click', function(event) {
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnMenuToggle = menuToggle.contains(event.target);

    if (!isClickInsideSidebar && !isClickOnMenuToggle && sidebar.classList.contains('show')) {
      toggleSidebar();
    }
  });

  // Handle window resize
  window.addEventListener('resize', function() {
    sidebar.classList.remove('show');
    content.classList.remove('shifted');
    header.classList.remove('shifted');
    footer.classList.remove('shifted');
    overlay.classList.remove('show');
    toggleIcon.classList.remove('fa-times');
    toggleIcon.classList.add('fa-bars');
    document.body.style.overflow = 'auto';
  });

  // Initialize on load
  sidebar.classList.remove('show');
  content.classList.remove('shifted');
  header.classList.remove('shifted');
  footer.classList.remove('shifted');
  overlay.classList.remove('show');
  toggleIcon.classList.remove('fa-times');
  toggleIcon.classList.add('fa-bars');
  document.body.style.overflow = 'auto';
});
