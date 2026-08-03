
document.addEventListener('DOMContentLoaded', function() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const body = document.getElementById('body');
  
    // Initialize the theme based on user's previous preference
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        body.classList.add('dark:bg-slate-700');
        body.classList.remove('bg-slate-200');
        lightIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        body.classList.remove('dark:bg-slate-700');
        body.classList.add('bg-slate-200');
        darkIcon.classList.remove('hidden');
    }
  
    // Toggle theme on button click
    themeToggleBtn.addEventListener('click', function() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            body.classList.remove('dark:bg-slate-700');
            body.classList.add('bg-slate-200');
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            body.classList.add('dark:bg-slate-700');
            body.classList.remove('bg-slate-200');
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
            localStorage.setItem('theme', 'dark');
        }
    });
});
