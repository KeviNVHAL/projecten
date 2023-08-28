document.addEventListener('DOMContentLoaded', function() {
    let colorSwitchBtn = document.getElementById('colorSwitch');
    let primaryColor = '#0DD6C2';
    let secondaryColor = '#fa6e79';

    colorSwitchBtn.addEventListener('click', function() {
        let navLinks = document.querySelectorAll('#navbar .link-primary, #navbar .link-secondary');
        let headerContent = document.getElementById('header-content');
        let headerImage = document.querySelector('#header-content img');
        let sections = document.querySelectorAll('section');
        let footer = document.querySelector('footer');

        navLinks.forEach(function(link) {
            if (link.classList.contains('link-primary')) {
                if (getComputedStyle(link).color === secondaryColor) {
                    link.style.color = primaryColor;
                } else {
                    link.style.color = secondaryColor;
                }
            } else if (link.classList.contains('link-secondary')) {
                if (getComputedStyle(link).color === primaryColor) {
                    link.style.color = secondaryColor;
                } else {
                    link.style.color = primaryColor;
                }
            }
        });

        if (getComputedStyle(headerContent).color === primaryColor) {
            headerContent.style.color = secondaryColor;
            headerImage.src = 'images/kvh-blauw.png';
        } else {
            headerContent.style.color = primaryColor;
            headerImage.src = 'images/kvh-roze.png';
        }

        sections.forEach(function(section, index) {
            let sectionBorderColor, sectionH2Color;

            if (index % 2 === 0) {
                sectionBorderColor = secondaryColor;
                sectionH2Color = primaryColor;
            } else {
                sectionBorderColor = primaryColor;
                sectionH2Color = secondaryColor;
            }

            section.style.borderColor = sectionBorderColor;
            section.querySelector('h2').style.color = sectionH2Color;
        });

        if (getComputedStyle(footer).backgroundColor === primaryColor) {
            footer.style.backgroundColor = secondaryColor;
        } else {
            footer.style.backgroundColor = primaryColor;
        }
    });
});

