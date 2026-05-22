class DoctorsFilter {
  constructor() {
    this.ajaxFile = "/ajax/doctorsFilter.php"
    this.filter = {}
    this.specInputValues = {}
    this.addressInputValues = {}
    this.mobileFilter
    this.messages = {
      ADDRESSES: "Все клиники",
      POSITIONS: "Все специальности",
    }

    this.init()
  }

  // Main initialization
  init() {
    this.initLoader()
    this.initCategoryButtons(".category-filter-button",".news-alphabet__block")
    this.initSpecialityFilters()
    this.initNameFilterForm()
    this.initFormSelectsHandlers(".doctors-filter__select.positions","SPECIALISTS")
    this.initFormSelectsHandlers(".doctors-filter__select.addresses","ADDRESS")
    this.showAllTypes("ADDRESSES")
    this.showAllTypes("POSITION")

    // List filter after DOM building
    this.collectFilter()
    this.sendAjax(this.filter)

    this.initMobileFilterHandler()
    this.initShowAllDirections()
    this.initMobileInputForm()
  }

  // Init mobile filter
  initMobileFilterHandler() {
    const self = this
    const filterOpener = document.querySelector(".doctors-filter__filter-opener")
    this.mobileFilter = document.querySelector(".doctors-filter-mobile")
    const fixedHeader = document.querySelector("#mobileheader")
    if (this.mobileFilter && filterOpener) {
      filterOpener.addEventListener("click", function () {
        self.mobileFilter.classList.add("active")
      })
      this.initFilterBtnHandler()
      this.initMobileFilterSections()
      this.initResetButton()
      this.initMobileItemsHandlers()
    }
  }

  // Adds listener to show more button, opens next-step block
  initShowAllDirections() {
    const self = this
    const showMoreButtons = document.querySelectorAll(".doctors-filter-mobile__show-more")
    const doctorsFilterBlock = document.querySelectorAll(".doctors-filter-mobile")
    if (showMoreButtons.length > 0 && doctorsFilterBlock.length > 0) {
      showMoreButtons.forEach((item) => {
        item.addEventListener("click", function (e) {
          e.preventDefault()
          let parentBlock = item.closest(".doctors-filter-mobile")
          parentBlock.classList.add("step-next")
          self.checkActiveElements(".doctors-filter-mobile__next-step-section.active .doctors-filter-mobile__item.next-step");
          return
        });
      });
    }
  }

  // Added neccecary classes to active element or remove it
  checkActiveElements(selector) {
    const elements = document.querySelectorAll(selector)
    if (elements.length === 0) return

    elements.forEach((elem) => {
      const positions = this.filter?.["POSITION"]
      const value = positions?.["VALUE"]

      if (value) {
        const result = value
          .split("$")
          .filter(Boolean)
          .map((s) => s.trim())

        result.forEach((selectedPosition) => {
          if ( selectedPosition === elem.getAttribute("data-filter-value") && !elem.classList.contains("selected")) {
            elem.classList.add("selected");
          }
        })
      } else {
        if (elem.classList.contains("selected")) {
          elem.classList.remove("selected")
        }
      }
    })
  }

  // Hanlers for search form in the next step filter
  initMobileInputForm() {
    const self = this
    const form = document.querySelector(".doctors-filter-mobile__form")

    if (!form) return

    const input = form.querySelector("input")
    const items = document.querySelectorAll(".doctors-filter-mobile__next-step-list span")
    const noResults = document.getElementById("noMobileFormResults")

    input.addEventListener("input", function (e) {
      if (input.value === "") {
        items.forEach((li) => {
          li.classList.remove("hidden")
          li.style.display = ""
        })
        noResults.style.display = "none"
      }
    })

    form.addEventListener("submit", function (e) {
      e.preventDefault()

      const query = input.value.trim().toLowerCase()

      let visibleCount = 0

      items.forEach((li) => {
        const text = li.textContent.trim().toLowerCase()
        if (text.includes(query)) {
          li.classList.remove("hidden")
          li.style.display = ""
          visibleCount++
        } else {
          li.classList.add("hidden")
          li.style.display = "none"
        }
      });

      noResults.style.display = visibleCount === 0 ? "" : "none"
    })
  }

  // First btn closes filter, a second one return to the previous step
  initFilterBtnHandler() {
    const self = this
    const buttons = document.querySelectorAll(".doctors-filter-mobile__back")
    if (buttons) {
      buttons.forEach((btn) => {
        btn.addEventListener("click", function () {
          if (btn.classList.contains("close-filter")) {
            self.closeMobileFilter()
          } else if (btn.classList.contains("to-first-step")) {
            let parentBlock = document.querySelector(".doctors-filter-mobile.step-next")
            if (parentBlock) {
              parentBlock.classList.remove("step-next")
            }
          }
        })
      })
    }
  }

  // Method adds listener to the mobile filter items and sends request
  initMobileItemsHandlers() {
    const self = this
    const items = document.querySelectorAll(".doctors-filter-mobile__item")
    if (!items) return

    items.forEach((item) => {
      item.addEventListener("click", function () {
        self.cleanedAllItemsStyle(items)
        item.classList.add("selected")
        let typeValue = item
          .getAttribute("data-filter-name")
          .replace("PROPERTY_PROP_", "")

        if (item.classList.contains("next-step")) {
          item.closest(".doctors-filter-mobile").classList.remove("step-next")
          self.closeMobileFilter()
        }

        self.filter[typeValue] = {
            NAME: `PROPERTY_PROP_${typeValue}`,
            VALUE: item.getAttribute("data-filter-value"),
        }

        self.sendAjax(self.filter)
      });
    });
  }

  // Cleans all selected elemenents
  cleanedAllItemsStyle(items) {
    items.forEach(item => item.classList.remove('selected'))
  }

  // Method checks chosen active section and show a nessesery block
  initMobileFilterSections() {
    let activeSectionId = this.filter.CATEGORY.VALUE
    const allSections = document.querySelectorAll(".mobile-blocks")
    if (allSections) {
      allSections.forEach((sec) => sec.classList.remove("active"))
    }
    document
      .querySelector(`#mobileFilterSpecialities__${activeSectionId}`)
      .classList.add("active")
    document
      .querySelector(`#mobileFilterAddresses__${activeSectionId}`)
      .classList.add("active")
    document
      .querySelector(`#mobileFilterAddressesNextStep__${activeSectionId}`)
      .classList.add("active")
  }

  // Button resets all filters but category
  initResetButton() {
    const self = this
    const resetBtn = document.getElementById("resetMobileFilter")
    if (resetBtn) {
      resetBtn.addEventListener("click", function () {
        const items = document.querySelectorAll(".doctors-filter-mobile__item")
        if (!items) return

        items.forEach((item) => {
          item.classList.remove("selected")
        })

        self.specInputValues = {}
        self.addressInputValues = {}
        self.sendAjax(this.filter, false, true)
        self.closeMobileFilter()
      })
    }
  }

  // Method closes mobile filter
  closeMobileFilter() {
    this.mobileFilter.classList.remove("active")
  }

  // Loader initialization
  initLoader() {
    document.body.classList.add("loaded_hiding")
    setTimeout(() => {
      document.body.classList.add("loaded")
      document.body.classList.remove("loaded_hiding")
    }, 500);
  }

  // Init buttons with categories
  initCategoryButtons(buttonSelector, blockSelector) {
    const buttons = document.querySelectorAll(buttonSelector)
    const blocks = document.querySelectorAll(blockSelector)
    if (!buttons.length || !blocks.length) return

    buttons.forEach((button) => {
      if (button.classList.contains("active")) {
        this.toggleAlphabetBlock(buttons, button)
      }

      button.addEventListener("click", (e) => {
        e.preventDefault()
        this.toggleAlphabetBlock(buttons, button)
        this.toggleFilterBlock(button)
        this.clearNameInput()
        this.collectFilter()
        this.sendAjax(this.filter, false, true)
        this.showAllTypes("ADDRESSES")
        this.showAllTypes("POSITION")
      });
    });
  }

  // Method toggles class for the alphabet block
  toggleAlphabetBlock(buttons, activeButton) {
    buttons.forEach((btn) => btn.classList.remove("active"))
    document.querySelectorAll(".news-alphabet__block").forEach((block) => block.classList.remove("active"))

    document.querySelectorAll(`[data-filter-value="${activeButton.getAttribute("data-filter-value")}"]`).forEach((btn) => {
        btn.classList.add("active")
    })

    const blockId = `alphabet-block_${activeButton.getAttribute("data-filter-value")}`
    document.getElementById(blockId)?.classList.add("active")
  }

  // Method toggles class for the filter block
  toggleFilterBlock(activeButton) {
    document.querySelectorAll(".doctors-filter__block").forEach((block) => block.classList.remove("active"))
    const blockId = `doctorsFilterBlock_${activeButton.getAttribute("data-filter-value")}`
    document.getElementById(blockId)?.classList.add("active")
  }

  // Initialization filters for the alphabet specialities
  initSpecialityFilters() {
    let self = this
    const specialityItems = document.querySelectorAll(".news-alphabet__speciality")

    specialityItems.forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault()

        const filter = this.collectFilter()

        self.filter.POSITION = {
          NAME: item.getAttribute("data-filter-name"),
          VALUE: item.getAttribute("data-filter-value"),
        }

        this.clearNameInput();

        document.querySelector(".doctors-listing-wrapper").scrollIntoView({ behavior: "smooth" })

        this.sendAjax(self.filter)
      })
    })
  }

  // Initialization the filter with a name search
  initNameFilterForm() {
    const form = document.getElementById("doctorsNameFilter")
    if (!form) return

    this.initNameInputHandler(form)

    form.addEventListener("submit", (e) => {
      e.preventDefault()
      const input = form.querySelector("input")
      const value = input?.value?.trim()
      const filter = this.collectFilter()

      if (value) {
        this.filter.NAME = {
          NAME: "NAME",
          VALUE: `%${value}%`,
        }
        form.querySelectorAll("button").forEach((btn) => btn.classList.toggle("active"))
      }

      this.sendAjax(this.filter)
    })
  }

  initNameInputHandler(form) {
    const self = this
    document.getElementById("nameInputCleaner").addEventListener("click", function (e) {
        e.preventDefault()
        form.querySelector("input").value = ""
        form.querySelectorAll("button").forEach((btn) => btn.classList.toggle("active"))
        delete self.filter.NAME
        self.sendAjax(self.filter)
      })
  }

  // Initialization selects in the filter
  initFormSelectsHandlers(selector, type) {
    document.querySelectorAll(selector).forEach((item) => {
      item.addEventListener("click", function () {
        item.classList.toggle("active")
      })
    })

    this.inputElementsHandler(selector)
  }

  // Main logic for custom selects in the filter
  inputElementsHandler(selector) {
    let self = this
    let mainBlocks = document.querySelectorAll(selector)

    if (!mainBlocks) return

    mainBlocks.forEach((mainBlock) => {
        mainBlock.querySelectorAll(".JSDropwownElements [data-filter-name]").forEach((item) => {
            item.addEventListener("click", function () {
                self.listItemsClassesHandler(item.getAttribute("data-filter-value"), selector)
                let checkTypeForAllItems = item.getAttribute("data-filter-value") === "all"

                if (checkTypeForAllItems) {
                    self.showAllTypes(mainBlock.getAttribute("name"))
                } else {
                    self.filter[mainBlock.getAttribute("name")] = {
                        NAME: `PROPERTY_PROP_${mainBlock.getAttribute("name")}`,
                        VALUE: item.getAttribute("data-filter-value"),
                    }
                }
                self.sendAjax(self.filter)
            })
        })
    })
  }

  // Cleans up classes and adds new one to neccecary item
  listItemsClassesHandler(value, selector) {
    let filterBlock = document.querySelector('.doctors-filter__block.active')
    if (!filterBlock) return

    filterBlock.querySelectorAll(`${selector} .JSDropwownElements span`).forEach(elem => {
        elem.classList.remove('selected')
        if (elem.getAttribute('data-filter-value') === value) {
            elem.classList.add('selected')
        }
    })
  }

  // Method called when user selects all types. This cleans data from select in the filter
  showAllTypes(filterType) {
    const select = document.querySelector(`.doctors-filter__select[name=${filterType}]`)
    
    if (!select) return

    if (this.filter[filterType]) {
      delete this.filter[filterType]
    }

    const selectByType = select.querySelector(
      `span[data-type="${filterType}"]`
    )

    if (selectByType) {
      selectByType.textContent = this.messages[filterType] ?? ""
    }

    select.querySelectorAll(".JSDropwownElements span").forEach((item, key) => {
      if (item.classList.contains("selected")) {
        item.classList.remove("selected")
      }

      if (key === 0) {
        item.classList.add("selected")
      }
    })
  }

  // Method makes right view of an object
  transformObj(obj, name) {
    let value = ""
    for (const key in obj) {
      value += obj[key] + "$"
    }
    let result = {
      NAME: name,
      VALUE: value,
    }
    return result
  }

  // Method checks element in an object, adds it or removes
  addOrToggleId(targetObj, id, value) {
    const newObj = { ...targetObj }
    if (Object.prototype.hasOwnProperty.call(newObj, id)) {
      delete newObj[id]
    } else {
      newObj[id] = value
    }
    return newObj
  }

  // Gets data from filter items
  getDataFromSelectForm(element, type) {
    const attrValue = element.value
    const attrName = element.name

    this.collectFilter()

    if (attrValue === "all") {
      delete this.filter[type]
    } else if (attrName && attrValue) {
      this.filter[type] = {
        NAME: attrName,
        VALUE: attrValue,
      }
      this.clearNameInput()
    }
    this.sendAjax(this.filter)
  }

  // Method cleans the input for name
  clearNameInput() {
    const form = document.getElementById("doctorsNameFilter")
    if (form) {
      form.querySelector("input").value = ""
    }
  }

  // A handler for showMoreButton
  showMoreHandler() {
    const showMoreBtn = document.getElementById("doctorsShowMore")

    if (!showMoreBtn) return

    let currentPage = parseInt(showMoreBtn.getAttribute("data-number"), 10) || 1
    const navNum = showMoreBtn.getAttribute("data-nav-num")
    const url = showMoreBtn.getAttribute("data-url")

    showMoreBtn.addEventListener("click", () => {
      this.showMoreListener(url, navNum, currentPage)
    })
  }

  // Adding listener for showMoreButton, send a request
  showMoreListener(url, navNum, currentPage) {
    if (!url) return;

    const nextPage = currentPage + 1
    const bodyParams = new URLSearchParams()

    bodyParams.append(`PAGEN_${navNum}`, nextPage)
    bodyParams.append("ajax", "Y")

    Object.entries(this.filter).forEach(([key, { NAME, VALUE }]) => {
      bodyParams.append(`filters[${key}][NAME]`, NAME)
      bodyParams.append(`filters[${key}][VALUE]`, VALUE)
    })

    fetch(this.ajaxFile, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: bodyParams.toString(),
    })
      .then((response) => {
        if (!response.ok)
          throw new Error("Ошибка при отправке данных на сервер")
        return response.text()
      })
      .then((html) => this.showMorePostHandler(html))
      .catch(console.error);
  }

  // Post handler for showMoreButton
  showMorePostHandler(html) {
    const temp = document.createElement("div")
    temp.innerHTML = html

    const newItems = temp.querySelectorAll(".doctors-listing__item")
    const tempPaginationBlock = temp.querySelector(".doctors-listing__pagination")
    const paginationBlock = document.querySelector(".doctors-listing__pagination")
    const container = document.querySelector(".doctors-listing.section")

    if (paginationBlock && tempPaginationBlock) {
      paginationBlock.innerHTML = tempPaginationBlock.innerHTML
    }

    if (newItems.length && container) {
      newItems.forEach((item) => container.appendChild(item))
    }

    // re-bind
    this.showMoreHandler()
  }

  // Method hides pagination
  hidePagination() {
    const paginations = document.querySelectorAll(".doctors-listing__pagination")
    paginations.forEach((pagination) => pagination.remove())
  }

  // Get a base filter
  collectFilter() {
    const activeButton = document.querySelector(".news-alphabet__button.active")

    if (activeButton) {
      this.filter.CATEGORY = {
        NAME: activeButton.getAttribute("data-filter-name"),
        VALUE: activeButton.getAttribute("data-filter-value"),
      }
    }
  }

  // The main request sender
  sendAjax(filterObject, showAll = false, clearFilter = false) {
    const formData = new URLSearchParams()

    if (clearFilter) {
      let categoryFilter = this.filter.CATEGORY
      this.filter = {}
      filterObject = {}
      this.filter.CATEGORY = categoryFilter
      filterObject.CATEGORY = categoryFilter
      this.clean
    }

    Object.entries(filterObject).forEach(([key, { NAME, VALUE }]) => {
      formData.append(`filters[${key}][NAME]`, NAME)
      formData.append(`filters[${key}][VALUE]`, VALUE)
    });

    fetch(this.ajaxFile, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: showAll ? [] : formData,
    })
      .then((response) => {
        if (!response.ok)
          throw new Error("Ошибка при отправке данных на сервер")
        return response.text()
      })
      .then((html) => {
        this.hidePagination()
        const container = document.querySelector(".doctors-listing-container")
        if (container) container.innerHTML = html

        this.showMoreHandler()

        this.fillFormData(
          '.doctors-filter__select.addresses .doctors-filter__input [data-type="ADDRESSES"]',
          this.messages["ADDRESSES"],
          "ADDRESSES"
        )
        this.fillFormData(
          '.doctors-filter__select.positions .doctors-filter__input [data-type="POSITIONS"]',
          this.messages["POSITIONS"],
          "POSITIONS"
        )
      })
      .catch(console.error)
  }

  // Method fills inputs after getting a request from an ajax file
  fillFormData(selector, word, key) {
    let filters = document.querySelector('.doctors-filter__block.active')
    if (filters) {
      let items = filters.querySelectorAll(`.doctors-filter__select[data-select-type="${key}"] .JSDropwownElements span`)
    
      items.forEach(item => {
        if (item.classList.contains('selected')) {
          document.querySelectorAll(selector).forEach(select => select.textContent = item.textContent)
        }
      })
    }
  }
}

// Class initialization after a page loading
document.addEventListener("DOMContentLoaded", () => new DoctorsFilter())
