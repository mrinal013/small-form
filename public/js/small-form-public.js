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
          if (this.emailEntry) {
            var emailValidation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
              this.emailEntry
            )
              ? true
              : false;

            console.log(emailValidation);
            if (emailValidation) {
              document
                .querySelector(".small-form button")
                .insertAdjacentHTML(
                  "afterend",
                  "<span class='spinner'>Working...</span>"
                );
              var queryString =
                "?action=small_form_submit&nonce=" +
                ajax_object.nonce +
                "&formid=" +
                formId +
                "&email=" +
                this.emailEntry +
                "&desc=" +
                this.descEntry;
              axios
                .get(ajax_object.ajax_url + queryString)
                .then(response => {
                  var element = document.querySelector(".spinner");
                  setTimeout(() => {
                    element.parentNode.removeChild(element);
                  }, 1000);
                })
                .catch(error => {
                  document
                    .querySelector(".small-form button")
                    .insertAdjacentHTML(
                      "beforebegin",
                      "<span class='error-message'>Can not be save!!!</span>"
                    );
                });
            } else {
              document
                .querySelector(".small-form input")
                .insertAdjacentHTML(
                  "afterend",
                  "<span class='error-message'>Invalid email address</span>"
                );
            }
          } else {
            console.log("email can not be empty");
            document
              .querySelector(".small-form input")
              .insertAdjacentHTML(
                "afterend",
                "<div class='error-message'>This field is required</div>"
              );
          }
        }
      },
      template:
        '<div class="small-form">\
          <label><span>{{emailLabel}}</span><span class="required">*</span><br>\
            <input type="text" v-model="emailEntry">\
          </label><br/>\
          <label><span>{{descLabel}}</span><br>\
            <textarea v-model="descEntry"></textarea>\
          </label><br>\
          <button @click="submitForm">{{submitText}}</button>\
        </div>'
    });
  });
});
