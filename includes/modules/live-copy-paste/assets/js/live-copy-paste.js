 // Wrap everything in an immediately invoked function expression (IIFE) for encapsulation
(function() {

  // Initialize the eleXdLocalStorage
  eleXdLocalStorage.init({
    iframeUrl: "https://easyelementspro.com/live-copy-paste/",
    initCallback: function() {}
  });

  // Array of element types
  const elementTypes = ["section", "column", "widget", "container"];

  // Array to store context menu groups
  const contextMenuGroups = [];

  // Event listener for when the preview is loaded
  elementor.on('preview:loaded', function() {

    // Loop through element types
    elementTypes.forEach(function(type, index) {
      // Add filter for context menu groups
      elementor.hooks.addFilter("elements/" + type + "/contextMenuGroups", function(groups, element) {
        contextMenuGroups.push(element);
        // Add custom actions to context menu
        //groups.push({
        groups.splice(index + 1, 0, {
          name: "easy_elements_" + type,
          actions: [{
            name: "easy_elements_addons_copy",
            title: "EE | Copy Element",
            icon: "pa-dash-icon",
            callback: function() {
              const copiedElementData = {
                eletype: type === "widget" ? element.model.get("widgetType") : null,
                elecode: element.model.toJSON()
              };
              eleXdLocalStorage.setItem("easy_elements-c-p-element", JSON.stringify(copiedElementData), function() {
                elementor.notifications.showToast({
                  message: elementor.translate('Copied')
                });
              });
            }
          }, {
            name: "easy_elements_addons_paste",
            title: "EE | Paste Element",
            icon: "pa-dash-icon",
            callback: function() {
              eleXdLocalStorage.getItem("easy_elements-c-p-element", function(item) {
                ElementCopyPasteHandler.copyElement(JSON.parse(item.value), element);
              });
            }
          },
            {
              name: "easy_elements_addons_copy_all",
              title: "EE | Copy Full Page",
              icon: "pa-dash-icon",
              callback: function() {
                const copiedSections = Object.values(elementor.getPreviewView().children._views).map(function(view) {
                  return view.getContainer();
                });
                const allSections = copiedSections.map(function(section) {
                  return section.model.toJSON();
                });

                eleXdLocalStorage.setItem('easy_elements-c-p-all', JSON.stringify(allSections), function() {
                  elementor.notifications.showToast({
                    message: elementor.translate('Copied')
                  });
                });
              }
            },
            {
              name: "easy_elements_addons_paste_all",
              title: "EE | Paste Full Page",
              icon: "pa-dash-icon",
              callback: function() {
                let allSections = '';
                eleXdLocalStorage.getItem('easy_elements-c-p-all', function(item) {
                  allSections = JSON.parse(item.value);
                  ElementCopyPasteHandler.pasteAllSections(JSON.stringify(allSections));
                });
              }
            },
          ]
        });
        return groups;
      });
    });

  });


  // Function to recursively assign unique IDs to elements in an array
  function assignUniqueIdsToElements(elements) {
    return elements.forEach(function(element) {
      element.id = elementorCommon.helpers.getUniqueId();
      if (element.elements.length > 0) {
        assignUniqueIdsToElements(element.elements);
      }
    }), elements;
  }

  // Object containing methods for copying and pasting elements
  const ElementCopyPasteHandler = {

    // Method for copying a single element
    copyElement: function(sourceElement, targetElement) {
      // Extract necessary data from the source element
      const sourceElementType = targetElement.model.get("elType");
      const copiedElement = sourceElement.elecode;
      const copiedElementJSON = JSON.stringify(copiedElement);

      // Check if the copied element contains an image file
      const containsImage = /\.(jpg|png|jpeg|gif|svg)/gi.test(copiedElementJSON);

      const copiedElementData = {
        elType: copiedElement.elType,
        settings: copiedElement.settings
      };

      let targetContainer = null;
      const options = {
        index: 0
      };

      // Determine the container and index for pasting the copied element based on its type
      switch (copiedElement.elType) {
        case "section":
        case "container":
          copiedElementData.elements = assignUniqueIdsToElements(copiedElement.elements);
          targetContainer = elementor.getPreviewContainer();
          break;
        case "column":
          copiedElementData.elements = assignUniqueIdsToElements(copiedElement.elements);
          if (["section", "container"].includes(sourceElementType)) {
            targetContainer = targetElement.getContainer();
            options.index = targetElement.getOption("_index") + 1;
          } else if (sourceElementType === "column") {
            targetContainer = targetElement.getContainer().parent;
            options.index = targetElement.getOption("_index") + 1;
          } else if (sourceElementType === "widget") {
            targetContainer = targetElement.getContainer().parent.parent;
            options.index = targetElement.getOption("_index") + 1;
          }
          break;
        case "widget":
          copiedElementData.widgetType = sourceElement.eletype;
          targetContainer = targetElement.getContainer();
          if (sourceElementType === "section") {
            targetContainer = targetElement.children.findByIndex(0).getContainer();
          } else if (sourceElementType === "column") {
            targetContainer = targetElement.getContainer();
          } else if (sourceElementType === "widget") {
            targetContainer = targetElement.getContainer().parent;
            options.index = targetElement.getOption("_index") + 1;
          }
          break;
      }

      // Create the copied element in the target container
      const newElement = $e.run("document/elements/create", {
        model: copiedElementData,
        container: targetContainer,
        options: options
      });

      // If the copied element contains an image, make an AJAX call to handle the image
      if (containsImage) {
        jQuery.ajax({
          url: easy_elements_cross_cp.ajax_url,
          method: "POST",
          data: {
            nonce: easy_elements_cross_cp.nonce,
            action: "easy_elements_cross_cp_import",
            copy_content: copiedElementJSON
          }
        }).done(function(response) {
          if (response.success) {
            const data = response.data[0];
            copiedElementData.elType = data.elType;
            copiedElementData.settings = data.settings;
            if (copiedElementData.elType === "widget") {
              copiedElementData.widgetType = data.widgetType;
            } else {
              copiedElementData.elements = data.elements;
            }
            $e.run("document/elements/delete", {
              container: newElement
            });
            $e.run("document/elements/create", {
              model: copiedElementData,
              container: targetContainer,
              options: options
            });
          }
        });
      }
    },

    // Method for pasting all sections
    pasteAllSections: function(allSections) {
      jQuery.ajax({
        url: easy_elements_cross_cp.ajax_url,
        method: "POST",
        data: {
          nonce: easy_elements_cross_cp.nonce,
          action: "easy_elements_cross_cp_import",
          copy_content: allSections
        },
      }).done(function(response) {
        if (response.success) {
          const data = response.data[0];
          const targetView = easy_elements_cross_cp.elementorCompatible ? elementor.sections.currentView : elementor.previewView;
          targetView.addChildModel(data);
          elementor.notifications.showToast({
            message: elementor.translate('Content Pasted. Have Fun ;)')
          });
        }
      }).fail(function() {
        elementor.notifications.showToast({
          message: elementor.translate('Something went wrong!')
        });
      });
    }

  };
})(jQuery);