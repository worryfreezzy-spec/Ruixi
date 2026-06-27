// set active menu class
document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll('a');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('selected');
        }
    });
});

// animation
const fadeElements = document.querySelectorAll('.fadit > *');
fadeElements.forEach(element => element.classList.add('fade'));

const upElements = document.querySelectorAll('.upit > *');
upElements.forEach(element => element.classList.add('fade-up'));

const options = {
    root: null,
    rootMargin: "0px",
    threshold: 0
};

function observerCallback(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("done");
        } else {
            entry.target.classList.remove("done");
        }
    });
}

const animatedElements = document.querySelectorAll('[class*=fade],[class*=zoom]');
const observer = new IntersectionObserver(observerCallback, options);
animatedElements.forEach(element => observer.observe(element));

// navbar animation
function altnav() {
    var header = document.querySelector("nav");
    function updateHeaderClass() {
        var distanceY = window.pageYOffset || document.documentElement.scrollTop;
        if (distanceY > 250) {
            header.classList.remove("alt");
        } else {
            header.classList.add("alt");
        }
    }
    updateHeaderClass();
    window.addEventListener('scroll', updateHeaderClass);
}

window.onload = function () {
    altnav();
}

// language switcher
document.addEventListener("DOMContentLoaded", function() {
    // Get all language links within the .lang div
    var langLinks = document.querySelectorAll('.lang a:not(.khpage)');
    
    // Get the slug based on the current page's URL
    var slug = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
    
    // Append the slug to all language links
    if (langLinks.length > 0) {
        langLinks.forEach(function(langLink) {
            langLink.href += slug;
        });
    }
})
    

// popup modal
const hide = (el) => {
    el.style.opacity = 1;
    function fade() {
        el.style.opacity -= 0.1;
        if (el.style.opacity <= 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    }
    fade();
};

document.addEventListener("DOMContentLoaded", function() {
    var notice = document.querySelector(".modal");
    if (notice) {
        notice.addEventListener("click", function(e) {
            hide(notice);
        });
    }
});