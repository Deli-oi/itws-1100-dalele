# Lab 6 - JavaScript and jQuery

## Links
- Homepage: (http://dalelerpi.eastus.cloudapp.azure.com/iit/Labs/Lab03b/)
- Lab 6 Page: (http://dalelerpi.eastus.cloudapp.azure.com/iit/Labs/Lab06/lab6.html)
- GitHub Repo: (https://github.com/Deli-oi/itws-1100-dalele)

---

## Problem 5 Explanation

When I first tried using `$('li').click(...)`, newly added list items didn't respond to clicks because jQuery only binds handlers to elements that exist at load time. I fixed this by using event delegation with `$('#labList').on('click', 'li', ...)`, which listens on the parent element and catches clicks from any `li` inside it — including ones added later.
