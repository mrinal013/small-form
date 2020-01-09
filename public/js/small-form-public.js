// collect all elements with smallformid data
var elements = document.querySelectorAll("[data-smallformid]");
// loop through each element
elements.forEach(function(element) {
  var formId = element.getAttribute("data-smallformid");
  // Do something with this element and its `atts`
  console.log(formId);
});
