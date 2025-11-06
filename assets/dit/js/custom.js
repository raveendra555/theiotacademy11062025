//--mega menu--//
// --------------------show on hover start----------//
const button = document.querySelector('.allCourseBtn');
const innerDiv = document.querySelector('.nsh-all-courses-hover');

button.addEventListener('mouseover', () => {
  innerDiv.style.display = 'block';
  button.children[0].style.transition = 'all .3s';
  button.children[0].style.transform = 'rotateZ(-180deg)';
});

innerDiv.addEventListener('mouseover', () => {
  innerDiv.style.display = 'block';
  button.children[0].style.transition = 'all .3s';
  button.children[0].style.transform = 'rotateZ(-180deg)';
});

innerDiv.addEventListener('mouseout', () => {
  innerDiv.style.display = 'none';
  button.children[0].style.transition = 'all .3s';
  button.children[0].style.transform = 'rotateZ(0deg)';
});

button.addEventListener('mouseout', () => {
  innerDiv.style.display = 'none';
  button.children[0].style.transition = 'all .3s';
  button.children[0].style.transform = 'rotateZ(0deg)';
});

// --------------------show on hover end----------//

// --------------all course change start-------------//

const nshachleft = document.getElementsByClassName('nsh-ach-left')[0].children;
const nshachright = [...document.getElementsByClassName('nsh-ach-right')];
const allcourseChange = (e) => {
  Array.from(nshachleft).forEach((element) => {
    element.classList.remove('courses-active-tab2');
    element.children[1].classList.remove('courses-active-icon');
    element.children[1].style.transform = 'rotateZ(0deg)';
  });
  e.target.classList.add('courses-active-tab2');
  e.target.children[1].classList.add('courses-active-icon');
  e.target.children[1].style.transform = 'rotateZ(90deg)';

  nshachright.forEach((element) => {
    element.classList.remove('d-flex');
    element.classList.add('d-none');
  });

  if (e.target.classList.contains('finanace')) {
    nshachright.forEach((element) => {
      // console.log("reached here", element)
      if (element.classList.contains('finanace')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('newanalyticscourse')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('newanalyticscourse')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('damlgenaicoursetb')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('damlgenaicoursetb')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('analytics')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('analytics')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('technology')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('technology')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('newwebdevelopmentcourse')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('newwebdevelopmentcourse')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('marketing')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('marketing')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else if (e.target.classList.contains('management')) {
    nshachright.forEach((element) => {
      if (element.classList.contains('management')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  } else {
    nshachright.forEach((element) => {
      if (element.classList.contains('sorttermcoursetb')) {
        element.classList.add('d-flex');
        element.classList.remove('d-none');
      }
    });
  }
};

Array.from(nshachleft).forEach((element) => {
  element.addEventListener('mouseover', (e) => {
    allcourseChange(e);
  });
});

//--for mobile--//

// const button2 = document.querySelector('.allCourseBtnfp');
// const buttonclose = document.querySelector('.allCourseBtnclose');
// const innerDiv2 = document.querySelector('.nsh-all-courses-hover');

// button2.addEventListener('click', () => {
//     innerDiv2.style.display = 'block';
//     buttonclose.style.display = 'block';
//     button2.style.display = 'none';
//     button2.children[0].style.transition = 'all .3s'
//     button2.children[0].style.transform = 'rotateZ(-180deg)'

// });
// buttonclose.addEventListener('click', () => {
//     innerDiv2.style.display = 'none';
//     buttonclose.style.display = 'none';
//     button2.style.display = 'block';
//     button2.children[0].style.transition = 'all .3s'
//     button2.children[0].style.transform = 'rotateZ(-180deg)'
// });
const allCourseBtnf = document.getElementsByClassName('allCourseBtnfp')[0];
const zeynep2 = document.getElementById('zeynep2');
const custumClose = document.getElementById('custum-close');
const zeynepOverlay2 = document.getElementsByClassName('zeynep-overlay2')[0];
const hasSubmenu = [...zeynep2.getElementsByClassName('has-submenu')];
const submenuHeader = [
  ...zeynep2.getElementsByClassName('submenu-header-phone')
];

allCourseBtnf.addEventListener('click', (e) => {
  zeynep2.classList.add('opened');
  zeynepOverlay2.style.display = 'block';
});

zeynepOverlay2.addEventListener('click', (e) => {
  zeynep2.classList.remove('opened');
  zeynepOverlay2.style.display = 'none';
});

hasSubmenu.forEach((element) => {
  element.addEventListener('click', (e) => {
    e.stopPropagation();
    e.target.children[1].classList.add('opened');
    e.target.children[1].classList.add('current');
  });
});

submenuHeader.forEach((element) => {
  element.addEventListener('click', (e) => {
    e.stopPropagation();
    e.target.parentNode.classList.remove('opened');
    e.target.parentNode.classList.remove('current');
  });
});

custumClose.addEventListener('click', () => {
  zeynep2.classList.remove('opened');
  zeynepOverlay2.style.display = 'none';
});

// Cache DOM elements
const zeynep = document.getElementById('zeynep');
const zeynepOverlay = document.querySelector('.zeynep-overlay');
const hasSubmenus = Array.from(zeynep.querySelectorAll('.has-submenu'));
const submenuCloseButtons = Array.from(
  zeynep.querySelectorAll('[data-submenu-close]')
);

// Function to open the submenu
function openSubmenu(menuId) {
  const submenu = document.getElementById(menuId);
  if (submenu) {
    submenu.classList.add('opened', 'current');
  }
}

// Function to close the submenu
function closeSubmenu(menuId) {
  const submenu = document.getElementById(menuId);
  if (submenu) {
    submenu.classList.remove('opened', 'current');
  }
}

// Open submenu on click based on the data-submenu attribute
hasSubmenus.forEach((element) => {
  const submenuLink = element.querySelector('[data-submenu]');
  if (submenuLink) {
    submenuLink.addEventListener('click', (e) => {
      e.preventDefault(); // Prevent the default anchor behavior
      e.stopPropagation();
      const menuId = submenuLink.getAttribute('data-submenu');
      openSubmenu(menuId);
    });
  }
});

// Close submenu on click based on the data-submenu-close attribute
submenuCloseButtons.forEach((button) => {
  button.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent the default anchor behavior
    e.stopPropagation();
    const menuId = button.getAttribute('data-submenu-close');
    closeSubmenu(menuId);
  });
});

// Close menu on overlay click
zeynepOverlay.addEventListener('click', (e) => {
  document.querySelectorAll('.submenu.opened').forEach((submenu) => {
    submenu.classList.remove('opened', 'current');
  });
  zeynepOverlay.style.display = 'none';
  zeynep.classList.remove('opened');
});

// Function to open the main menu (optional if you're using a button to open the main menu)
function openMainMenu() {
  zeynep.classList.add('opened');
  zeynepOverlay.style.display = 'block';
}

// Function to close the main menu
function closeMainMenu() {
  zeynep.classList.remove('opened');
  zeynepOverlay.style.display = 'none';
}

// Example: If you have a button to open the main menu
const btnOpen = document.querySelector('.btn-open');
if (btnOpen) {
  btnOpen.addEventListener('click', openMainMenu);
}

// Example: Close the main menu when clicking a close button (optional)
const btnClose = document.querySelector('.btn-close');
if (btnClose) {
  btnClose.addEventListener('click', closeMainMenu);
}
// --------------all course change end-------------//

//--navbar serach data--/
function SearchDataForm(keyData) {
  var keyValue = keyData.value.trim();

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'SearchData/searchfunction', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        populateDataSearch(JSON.parse(xhr.responseText));
      } else {
        console.log('An error occurred.');
      }
    }
  };

  xhr.send('keyValue=' + encodeURIComponent(keyValue));

  function populateDataSearch(data) {
    console.log(data);
    var searchMenu = document.getElementById('search-menu');
    searchMenu.innerHTML = '';

    var searchData = document.querySelector('.searchData');
    if (data.length > 0) {
      searchData.style.display = 'block';
      data.forEach(function (item) {
        var listItem = document.createElement('li');
        listItem.className = 's-course-items';
        var elem = document.createElement('a');
        elem.href = 'https://www.theiotacademy.co/' + item.route;
        elem.className = 'tiamenuitem';
        elem.textContent = item.title;
        listItem.appendChild(elem);
        searchMenu.appendChild(listItem);
      });
    }
    
     else {
      searchData.style.display = 'none';
    }
  }
}

document.addEventListener('click', function (e) {
  var searchMenu = document.getElementById('search-menu');
  var searchData = document.querySelector('.searchData');

  if (
    !(
      e.target.id === 'search-menu' ||
      e.target.classList.contains('s-course-items')
    )
  ) {
    searchData.style.display = 'none';
  } else {
    searchData.style.display = 'block';
  }
});

//--scroll up btn --//
document.addEventListener('DOMContentLoaded', function () {
  var totop = document.getElementById('scrollUp');

  if (totop) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 150) {
        totop.style.display = 'block';
      } else {
        totop.style.display = 'none';
      }
    });

    totop.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});

// country Code js start here
const countries = [
  { name: 'India', code: 'IN', phone: 91 },
  { name: 'Pakistan', code: 'PK', phone: 92}
];

let countryCodeValue = '';
for (let i = 0; i < countries.length; i++) {
  if (countries[i].phone) {
    countryCodeValue += `
      <option value="+${countries[i].phone}">+${countries[i].phone} ${countries[i].code}</option>
    `;
  }
}

const elementsToUpdate = [
  'selectedCountryEnq',
  'selectedCountryDemo',
  'selectedCountry',
  'CountryDwnlCurriculum',
  'CountryDownloadBr'
];

elementsToUpdate.forEach((id) => {
  const element = document.getElementById(id);
  if (element) {
    element.innerHTML = countryCodeValue;
  }
});
