// collect all elements with smallformid data
var elements = document.querySelectorAll("[data-smallformid]");
// loop through each element
elements.forEach(function(element) {
  var formId = element.getAttribute("data-smallformid");
  axios.get("/wp-json/wp/v2/small-form/" + formId).then(response => {
    var small_form_meta = response.data._small_form_meta;
    var vm = new Vue({
      el: element,
      data: function() {
        return {
          emailEntry: null,
          descEntry: null
        };
      },
      created: function() {
        this.emailLabel = small_form_meta.email_label;
        this.descLabel = small_form_meta.desc_label;
        this.submitText = small_form_meta.submit_text;
      },
      methods: {
        submitForm: function() {
          var queryString =
            "?action=small_form_submit&email=" +
            this.emailEntry +
            "&desc=" +
            this.descEntry;
          axios.get(ajax_object.ajax_url + queryString);
        }
      },
      template:
        '<div class="small-form">\
          <label>{{emailLabel}}<br>\
            <input type="text" v-model="emailEntry">\
          </label><br/>\
          <label>{{descLabel}}<br>\
            <textarea v-model="descEntry"></textarea>\
          </label><br>\
          <button @click="submitForm">{{submitText}}</button>\
        </div>'
    });
  });
});
