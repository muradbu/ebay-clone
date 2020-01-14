function getCategoryById(dom) {
  $.ajax({
    url: "/api/getCategoriesById",
    data: {
      id: dom.id
    },

    success: response => {
      $("#CategoryId").val(dom.id);
      $("#dropdowntext" + dom.name).text(dom.text);
      $("[name=categorydropdown]").each(function() {
        if (this.id.match(/\d/g).join("") > dom.name) {
          this.remove();
        }
      });
      if (JSON.parse(response).length > 0) {
        var element = document.getElementById("dropdownparent");
        element.innerHTML += `
            <div name="categorydropdown" style="margin: 5px 10px 10px 15px" id="categorydropdown${parseInt(
              dom.name
            ) + 1}"
                <div class="dropdown">
                    <a id="dropdowntext${parseInt(dom.name) +
                      1}" class="btn dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid rgba(0, 0, 0, 0.15)!important;border-radius: 0.25rem;">
                        Kies groep*
                    </a>
                    <div class="dropdown-menu scrollable-menu" onclick="getCategoryById(event.srcElement)">
                        ${JSON.parse(response)
                          .map(
                            category =>
                              `<a name="${parseInt(dom.name) + 1}" id="${
                                category.CategoryId
                              }" class='dropdown-item'>${category.CategoryName.trim()}</a>`
                          )
                          .join("")}
                    </div></div>
            </div>`;
      }
    }
  });
}
