
// funkcja pobierająca klasę z documentu
  function querySelector(baseElement, selector) {
    return baseElement.querySelector(selector);
  }
// funkcja pobierająca id z documentu
  function getElementById(baseElement, id) {
    return baseElement.getElementById(id);
  }
// funkcja pobierająca elementy po tagu z documentu
  function getElementsByTagName(baseElement, tag) {
    return baseElement.getElementsByTagName(tag);
  }
// funkcja pobierająca wszystkei elementy z klasą
  function querySelectorAll(baseElement, selector) {
    return baseElement.querySelectorAll(selector);
  }
// function toggle menu after click in menu button
  function openHamburgerMenu(event, thiss, mainMenu, filteringMenu) {
    event.stopPropagation();
    thiss.classList.toggle('active');

    if (thiss.classList.contains('top-menu__btn')) {
      mainMenu.classList.toggle('active');
    }

    if (thiss.classList.contains('middle-menu__btn')) {
      filteringMenu.classList.toggle('active');

      if (thiss && document.querySelector('.middle-menu') && window.innerWidth < 768) {
        document.querySelector('.middle-menu').classList.toggle('active');
      }
      if (thiss && document.querySelector('.middle-menu') && window.innerWidth >= 768) {
        $(document.querySelector('.middle-menu__header')).toggle();
      }
    }

    const spans = getElementsByTagName(thiss, 'span');
    for (i = 0; i<spans.length; i++) {
      spans[i].classList.toggle('active');
    }

    $(overlay).fadeToggle();
    $(mainMenu).find('.sub-menu').slideUp("slow");
    $(filteringMenu).find('.sub-menu').slideUp("slow");
  }

// funkcja otwierająca sub-menu
function open_Sub_Menu(parent) {
  const subMenu = $(parent).find('.sub-menu');
  subMenu.slideToggle("slow");
}

// close menu after click somewhere
  function closeHamburgerMenuAfterClickOverlay(hamburgerBtns, mainMenu, filteringMenu) {
    if (mainMenu.classList.contains('active') || filteringMenu.classList.contains('active')) {
      for (i = 0; i < hamburgerBtns.length; i++) {
        hamburgerBtns[i].classList.remove('active');

        const spans = getElementsByTagName(hamburgerBtns[i], 'span');
        for (k = 0; k < spans.length; k++) {
          spans[k].classList.remove('active');
        }
      }

    if (document.querySelector('.middle-menu') && window.innerWidth >= 768) {
      $(document.querySelector('.middle-menu__header')).show();
    }

    if (document.querySelector('.middle-menu')) {
      filteringMenu.classList.remove('active');
    }

    mainMenu.classList.remove('active');
    $(overlay).fadeOut();
    $(mainMenu).find('.sub-menu').slideUp("slow");

    }
  }

// zamknięcie menu dla szerokości od 992px
  function closeHamburgerMenuAfterChangeWidth(hamburgerBtns, mainMenu, filteringMenu, overlay) {
    if (window.innerWidth >= 992) {
      for (i = 0; i < hamburgerBtns.length; i++) {
        hamburgerBtns[i].classList.remove('active');

        const spans = getElementsByTagName(hamburgerBtns[i], 'span');
        for (k = 0; k < spans.length; k++) {
          spans[k].classList.remove('active');
        }
      }

      if (document.querySelector('.middle-menu')) {
        filteringMenu.classList.remove('active');
      }

      mainMenu.classList.remove('active');
      $(overlay).fadeOut();
      $(mainMenu).find('.sub-menu').slideUp("slow");
    }
  }

// toogle class "container" dla top-menu i middle-menu dla szerokości okna >= 992
function changeMenuClass(baseElement) {
  const topMenuContainer = querySelector(baseElement, '.top-menu');
  if (document.querySelector('.middle-menu')) {
    var filteringMenuContainer = querySelector(baseElement, '.middle-menu');
  }
  if (window.innerWidth >= 992) {
    topMenuContainer.classList.add('container');
    if (filteringMenuContainer) {
      filteringMenuContainer.classList.add('container');
    }
  }
  window.addEventListener('resize', debounce(function() {
    topMenuContainer.classList.toggle('container', window.innerWidth >= 992);
    if (filteringMenuContainer) {
      filteringMenuContainer.classList.toggle('container', window.innerWidth >= 992);
    }
  }, 250), false);
}


// dwie wersje debounce dla np. resize
// var debounce =  function (func, wait, scope) {
//         var timeout;
//         return function () {
//             var context = scope || this, args = arguments;
//             var later = function () {
//                 timeout = null;
//                 func.apply(context, args);
//             };
//             clearTimeout(timeout);
//             timeout = setTimeout(later, wait);
//         };
//     }

//debounce <- używam
function debounce(fn, delay) {
  var timer = null;
  return function () {
    var context = this,
        args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function() {
      fn.apply(context, args);
    }, delay);
  };
}







window.addEventListener('load', function() {

// menu główne
  const mainMenu = getElementById(document, 'main-menu'),
// menu filtrowania realizacji
        filteringMenu = getElementById(document, 'filtering-menu'),
// hamburger menu
        hamburgerBtns = querySelectorAll(document, '.ham-btn')
// top-menu__overlay
        overlay = querySelector(document, '.top-menu__overlay'),
// menu-item-has-children
        menuItemHasChildren = querySelectorAll(document, '.menu-item-has-children');

// wywołanie funkcji otwierającej jakikolwiek z 2 hamburger menu
for (i = 0; i < hamburgerBtns.length; i++) {
  hamburgerBtns[i].addEventListener('click', function(event) {
    openHamburgerMenu(event, this, mainMenu, filteringMenu);
  }, false);
}

// wywołanie funkcji otwierającej sub-menu
  for (i = 0; i < menuItemHasChildren.length; i++) {
    menuItemHasChildren[i].addEventListener('click', function () {
      open_Sub_Menu(this);
    }, false);
  }

// wywołanie funkcji zamykającej hamburger menu po kliknięciu gdziekolwiek
  overlay.addEventListener('click', function () {
    closeHamburgerMenuAfterClickOverlay(hamburgerBtns, mainMenu, filteringMenu);
  }, false);

// wywołanie funkcji zamykającej hamburger menu przy window width > 992
  window.addEventListener('resize', debounce(function() {
    closeHamburgerMenuAfterChangeWidth(hamburgerBtns, mainMenu, filteringMenu, overlay)}, 250)
  , false)

// wywołanie funkcji: zmiana klasy dodatkowej dla .top-menu, powyżej 992px szerokości okna
// zmiana wpływa na szerokość rozwijanego menu na mobilkach
  changeMenuClass(document);

}, false); //end of window.addEventListener('load', function(){})
