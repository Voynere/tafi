class MenuManager {
  constructor() {
    this.timeouts = new Map();
    this.initDropdowns();
  }

  clearTimeoutFor(element) {
    if (this.timeouts.has(element)) {
      clearTimeout(this.timeouts.get(element));
      this.timeouts.delete(element);
    }
  }

  clearAllTimeouts() {
    this.timeouts.forEach((timeoutId, element) => {
      clearTimeout(timeoutId);
    });
    this.timeouts.clear();
  }

  setHoverTimeout(element, callback, delay) {
    this.clearTimeoutFor(element);
    const timeoutId = setTimeout(() => {
      this.timeouts.delete(element);
      callback();
    }, delay);
    this.timeouts.set(element, timeoutId);
  }

  initDropdowns() {
    const dropdowns = document.querySelectorAll('.main-nav-menu .dropdown');

    console.log(dropdowns);
    
    dropdowns.forEach(dropdown => {
      // Показ меню
      dropdown.addEventListener('mouseenter', (e) => {
        e.stopPropagation();
        this.clearTimeoutFor(dropdown);
        dropdown.classList.add('hover');
      });

      // Скрытие меню с проверкой
      dropdown.addEventListener('mouseleave', (e) => {
        const relatedTarget = e.relatedTarget;
        
        // Проверяем, не перешел ли курсор на дочерний элемент
        if (!relatedTarget || !dropdown.contains(relatedTarget)) {
          this.setHoverTimeout(dropdown, () => {
            // Дополнительная проверка перед скрытием
            if (!dropdown.matches(':hover') && !this.isAnyChildHovered(dropdown)) {
              dropdown.classList.remove('hover');
            }
          }, 150);
        }
      });

      // Предотвращаем всплытие событий от вложенных меню
      const submenu = dropdown.querySelector('.main-nav-menu__submenu, .main-nav-menu__submenu2');
      if (submenu) {
        submenu.addEventListener('mouseenter', (e) => {
          e.stopPropagation();
          this.clearTimeoutFor(dropdown);
        });

        submenu.addEventListener('mouseleave', (e) => {
          const relatedTarget = e.relatedTarget;
          if (!relatedTarget || !dropdown.contains(relatedTarget)) {
            this.setHoverTimeout(dropdown, () => {
              dropdown.classList.remove('hover');
            }, 150);
          }
        });
      }
    });

  
    
    // Закрытие меню при клике вне
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.main-nav-menu')) {
        this.closeAllMenus();
      }
    });

    // Закрытие меню при уходе с навигации
    document.querySelector('.main-nav-menu').addEventListener('mouseleave', (e) => {
      if (!e.relatedTarget || !e.relatedTarget.closest('.main-nav-menu')) {
        this.setHoverTimeout('global', () => {
          this.closeAllMenus();
        }, 300);
      }
    });
  }

  isAnyChildHovered(element) {
    const hoveredChildren = element.querySelectorAll(':hover');
    return hoveredChildren.length > 0;
  }



  closeAllMenus() {
    this.clearAllTimeouts();
    document.querySelectorAll('.dropdown.hover, .main-nav-menu__submenu-item.hover').forEach(item => {
      item.classList.remove('hover');
    });
  }

  // Метод для ручного закрытия всех меню
  close() {
    this.closeAllMenus();
  }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
  window.menuManager = new MenuManager();
  window.menuManager.initDropdowns();
});