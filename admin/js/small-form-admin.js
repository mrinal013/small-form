new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    items: [
      { title: "Click Me1" },
      { title: "Click Me2" },
      { title: "Click Me3" },
      { title: "Click Me4" }
    ]
  })
});
if (document.getElementById("dash")) {
  new Vue({
    el: "#dash",
    vuetify: new Vuetify()
  });
}
if (document.getElementById("tool")) {
  new Vue({
    el: "#tool",
    vuetify: new Vuetify()
  });
}
if (document.getElementById("help")) {
  new Vue({
    el: "#help",
    vuetify: new Vuetify()
  });
}
