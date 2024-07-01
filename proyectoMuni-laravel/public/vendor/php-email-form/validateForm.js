class t {
    static isInt(t) {
      return t === parseInt(t, 10);
    }
    static isFloat(t) {
      return t === parseFloat(t);
    }
    static isNumber(t) {
      return /^[0-9.]+$/.test(t);
    }
    static isEmail(t) {
      return /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(.\w{2,4})+$/.test(t);
    }
    static verificaCuentaBancaria(t) {
      const e = "00" + t.substr(0, 8),
        i = t.substr(8, 2),
        r = t.substr(10),
        n = [1, 2, 4, 8, 5, 10, 9, 7, 3, 6];
      let a = 0,
        s = 0;
      for (let t = 0; t <= 9; t += 1) a += parseInt(e.charAt(t), 10) * n[t];
      (a = 11 - (a % 11)), 11 === a && (a = 0), 10 === a && (a = 1);
      for (let t = 0; t <= 9; t += 1) s += parseInt(r.charAt(t), 10) * n[t];
      return (
        (s = 11 - (s % 11)),
        11 === s && (s = 0),
        10 === s && (s = 1),
        a.toString() + s.toString() === i
      );
    }
    static verificaRut(t) {
        // dejar solo números y letras 'k'
        const rutLimpio = t.replace(/[^0-9kK]/g, '');

        // verificar que ingrese al menos 2 caracteres válidos
        if (rutLimpio.length < 2) return false;

        // asilar el cuerpo del dígito verificador
        const cuerpo = rutLimpio.slice(0, -1);
        const dv = rutLimpio.slice(-1).toUpperCase();

        // validar que el cuerpo sea numérico
        if (!cuerpo.replace(/[^0-9]/g, '')) return false;

        // calcular el DV asociado al cuerpo del RUT
        const dvCalculado = calcularDV(cuerpo);

        // comparar el DV del RUT recibido con el DV calculado
        return dvCalculado == dv;
    }
    static calcularDV(cuerpoRUT) {
      let suma = 1;
      let multiplo = 0;
    
      for (; cuerpoRUT; cuerpoRUT = Math.floor(cuerpoRUT / 10))
        suma = (suma + (cuerpoRUT % 10) * (9 - (multiplo++ % 6))) % 11;
    
      return suma ? suma - 1 : 'K';
    }
    static verificaNumTarjetaCredito(e) {
      let i = !1;
      const r = [3, 4, 5, 6].includes(e[0]);
      return (
        16 === e.length && r && (i = t._getCtrlNumberCreditCard(e) === e[15]), i
      );
    }
    static _getCtrlNumberCreditCard(t) {
      let e,
        i,
        r = 0;
      for (e = 1; e < 16; e += 1)
        e / 2 !== parseInt(e / 2, 10)
          ? ((i = 2 * parseInt(t[e - 1], 10)), i >= 10 && (i -= 9))
          : (i = parseInt(t[e - 1], 10)),
          (r += i);
      return (r = 10 - (r % 10)), 10 === r && (r = 0), r;
    }
    static isAlpha(t) {
      return /^[A-Za-z\s\xF1\xD1áéíóúÁÉÍÓÚäëïöüAËÏÖÜÑñçÇ']+$/.test(t);
    }
    static isAlphaGuion(t) {
      return /^[A-Za-z\s\xF1\xD1áéíóúÁÉÍÓÚäëïöüAËÏÖÜÑñçÇ'-]+$/.test(t);
    }
    static isAlphaNumeric(t) {
      return /^[0-9A-Za-záéíóúÁÉÍÓÚäëïöüAËÏÖÜÑñçÇ']+$/.test(t);
    }
    static isAlphaNumericSpace(t) {
      return /^[0-9A-Za-z\s\xF1\xD1áéíóúÁÉÍÓÚäëïöüAËÏÖÜÑñçÇ']+$/.test(t);
    }
    static isDate(t, e) {
      if ("" === t) return !1;
      const i = t.match(/^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/);
      if (null === i) return !1;
      let r, n, a;
      switch (e) {
        case "mdy":
          [, r, , n, , a] = i;
          break;
        case "ymd":
          [, a, , , , r, , n] = i;
          break;
        default:
          [, n, , r, , a] = i;
      }
      if (r < 1 || r > 12) return !1;
      if (n < 1 || n > 31) return !1;
      if ([4, 6, 9, 11].includes(r) && 31 === n) return !1;
      if (2 === r) {
        const t = a % 4 == 0 && (a % 100 != 0 || a % 400 == 0);
        if (n > 29 || (29 === n && !t)) return !1;
      }
      return !0;
    }
    static checkNumMovil(t) {
      return new RegExp(
        /^(\+?[0-9]{2}|00[0-9]{2}|[0-9]{2})?[ -]*(6|7)[0-9]{8}$/
      ).test(t);
    }
    static checkNumFijo(t) {
      return new RegExp(/^(\+?[0-9]{2}|00[0-9]{2}|[0-9]{2})?[ -]*[0-9]{9}$/).test(
        t
      );
    }
    static checkTelephoneNumber(e) {
      return t.checkNumFijo(e) || t.checkNumMovil(e);
    }
    static checkCodPostal(e) {
      return 5 === e.length && t.isInt(e);
    }
    static checkICCID(e) {
      const i = parseInt(e.substring(e.length - 1, e.length), 10),
        r = e.substring(0, e.length - 1);
      return "89" !== e.substring(0, 2)
        ? 0
        : t._CalculateLuhn(r) === parseInt(i, 10) &&
          (19 === e.length || 20 === e.length)
        ? 1
        : 0;
    }
    static _CalculateLuhn(t) {
      let e = 0;
      for (let i = 0; i < t.length; i += 1)
        e += parseInt(t.substring(i, i + 1), 10);
      const i = [0, 1, 2, 3, 4, -4, -3, -2, -1, 0];
      for (let r = t.length - 1; r >= 0; r -= 2) {
        e += i[parseInt(t.substring(r, r + 1), 10)];
      }
      let r = e % 10;
      return (r = 10 - r), 10 === r && (r = 0), r;
    }
    static calcDigitoControl2LineaNIF(t) {
      const e = [7, 3, 1];
      let i = 0;
      const r = t.length;
      for (let n = 0; n < r; n += 1) i += t[n] * e[n % 3];
      return i % 10;
    }
    static _getLetraNIF(t) {
      return "TRWAGMYFPDXBNJZSQVHLCKE".charAt(t % 23);
    }
    static validaNifCifNie(t) {
      let e,
        i,
        r,
        n,
        a,
        s = t.toUpperCase();
      let l, d, c, o;
      if (
        "PASAPORTE" ===
        document.getElementById("documento_de_identidad").getAttribute("value")
      )
        return 1;
      if ("" !== s) {
        if (
          !/^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$/.test(s) &&
          !/^[T]{1}[A-Z0-9]{8}$/.test(s) &&
          !/^[0-9]{8}[A-Z]{1}$/.test(s)
        )
          return 0;
        if (/^[0-9]{8}[A-Z]{1}$/.test(s))
          return (
            (l = t.substring(8, 0) % 23),
            (d = "TRWAGMYFPDXBNJZSQVHLCKE".charAt(l)),
            (c = s.charAt(8)),
            d === c ? 1 : -1
          );
        for (
          o =
            parseInt(t.charAt(2), 10) +
            parseInt(t.charAt(4), 10) +
            parseInt(t.charAt(6), 10),
            r = 1;
          r < 8;
          r += 2
        )
          (e = 2 * parseInt(t.charAt(r), 10)),
            (e += ""),
            (e = e.substring(0, 1)),
            (i = 2 * parseInt(t.charAt(r), 10)),
            (i += ""),
            (i = i.substring(1, 2)),
            "" === i && (i = "0"),
            (o += parseInt(e, 10) + parseInt(i, 10));
        if (
          ((o += ""),
          (n = 10 - parseInt(o.substring(o.length - 1, o.length), 10)),
          /^[KLM]{1}/.test(s))
        )
          return t.charAt(8) === String.fromCharCode(64 + n) ? 1 : -1;
        if (/^[ABCDEFGHJNPQRSUVW]{1}/.test(s))
          return (
            (s = "" + n),
            t.charAt(8) === String.fromCharCode(64 + n) ||
            t.charAt(8) === parseInt(s.substring(s.length - 1, s.length), 10)
              ? 2
              : -2
          );
        if (/^[T]{1}[A-Z0-9]{8}$/.test(s))
          return t.charAt(8) === /^[T]{1}[A-Z0-9]{8}$/.test(s) ? 3 : -3;
        if (/^[XYZ]{1}/.test(s))
          return (
            (s = s.replace("X", "0")),
            (s = s.replace("Y", "1")),
            (s = s.replace("Z", "2")),
            (a = s.substring(0, 8) % 23),
            t.toUpperCase().charAt(8) ===
            "TRWAGMYFPDXBNJZSQVHLCKE".substring(a, a + 1)
              ? 3
              : -3
          );
      }
      return 0;
    }
  }
  class e {
    constructor(e, i = {}) {
      if (
        ((this.submitCallback = e || this._submitCallback),
        (this.warningColor = i.warningColor || "#F00"),
        (this.asteriskStyle =
          i.asteriskStyle ||
          `color: ${this.warningColor}!important; font-size: 15px!important; padding-left:3px;`),
        (this.cssTextWarning =
          i.cssTextWarning || `color:${this.warningColor}!important; margin:0;`),
        (this.cssElementWarning =
          i.cssElementWarning ||
          `border:2px solid ${this.warningColor}!important;`),
        (this.numWarnings = 0),
        (this.texts = {
          requiredField: "campo requerido",
          wrongValue: "valor incorrecto"
        }),
        (this.badValue = 0),
        (this.fieldsToValidate = [
          ...document.querySelectorAll("form[data-validate=true]")
        ]),
        (this.submitElementsToCheck = null),
        (this.okFieldsNoEmpty = !1),
        (this.okFieldsValidated = !1),
        (this.formId = null),
        (this.validationTypeFunctions = {
          int: t.isInt,
          integer: t.isInt,
          float: t.isFloat,
          number: t.isNumber,
          numero: t.isNumber,
          alpha: t.isAlpha,
          alfa: t.isAlpha,
          text: t.isAlpha,
          texto: t.isAlpha,
          "text-": t.isAlphaGuion,
          alphaNumericSpace: t.isAlphaNumericSpace,
          textspace: t.isAlphaNumericSpace,
          alphaNumeric: t.isAlphaNumeric,
          textnum: t.isAlphaNumeric,
          email: t.isEmail,
          correo: t.isEmail,
          iccid: t.checkICCID,
          nummovil: t.checkNumMovil,
          movil: t.checkNumMovil,
          mobile: t.checkNumMovil,
          numfijo: t.checkNumFijo,
          fijo: t.checkNumFijo,
          landphone: t.checkNumFijo,
          telefono: t.checkTelephoneNumber,
          tel: t.checkTelephoneNumber,
          telephone: t.checkTelephoneNumber,
          cp: t.checkCodPostal,
          postalcode: t.checkCodPostal,
          cuentabancaria: t.verificaCuentaBancaria,
          accountnumber: t.verificaCuentaBancaria,
          tarjetacredito: t.verificaNumTarjetaCredito,
          creditcard: t.verificaNumTarjetaCredito,
          rut: t.varificaRut,
          nif: t.valida_nif_cif_nie,
          cif: t.valida_nif_cif_nie,
          nie: t.valida_nif_cif_nie,
          fecha: t.isDate,
          date: t.isDate
        }),
        this.fieldsToValidate.forEach((t) => {
          this.markRequiredFields(t),
            "true" === t.dataset.checkrealtime &&
              this.addEventsToCheckFieldsWhenBlur(t),
            this.hiddenFieldsActions(t);
          const e = t.getAttribute("id");
          document
            .querySelectorAll(`#${e} [type=submit][data-checkform=true]`)
            .forEach((e) => {
              const i = e;
              (i.formParam = t),
                i.addEventListener("click", this._beforeSubmit.bind(this), !1);
            });
        }),
        null === document.getElementById("valiformStyles"))
      ) {
        const t = document.createElement("style");
        t.setAttribute("id", "valiformStyles"),
          t.setAttribute("type", "text/css"),
          (t.innerHTML = ".isHidden{ display:none; }"),
          document.getElementsByTagName("head")[0].appendChild(t);
      }
    }
    _beforeSubmit(t) {
      return (
        t.preventDefault(),
        t.stopPropagation(),
        (this.okFieldsNoEmpty = this.noEmptyFields()),
        (this.okFieldsValidated = this.validateFields()),
        this.okFieldsValidated && this.okFieldsNoEmpty && this.submitCallback(),
        !1
      );
    }
    _submitCallback(t) {
      this._null = null;
      const { target: e } = t;
      e.formParam.submit();
    }
    validate(t, e) {
      return (
        "" === t ||
        null === t ||
        ("" !== t && "noempty" === e) ||
        ("selected" === e || "noempty" === e
          ? "" !== t
          : !!this.validationTypeFunctions[e] &&
            this.validationTypeFunctions[e](t))
      );
    }
    markRequiredFields(t, e) {
      if (void 0 === t) return !1;
      const i = void 0 !== e ? e : "*",
        r = t.getAttribute("id");
      return (
        [...document.querySelectorAll(`#${r} [data-required=true]`)].forEach(
          (t) => {
            if (
              "hidden" !== (t.getAttribute("type") || t.type) &&
              "true" !== t.getAttribute("data-hidden")
            ) {
              const e = t.getAttribute("name");
              if (null === document.getElementById("asterisco_" + e)) {
                const r = document.createElement("span");
                if (
                  (r.setAttribute("id", "asterisco_" + e),
                  r.setAttribute("style", this.asteriskStyle),
                  (r.innerHTML = i),
                  null !== document.getElementById("label_" + e))
                )
                  document.getElementById("label_" + e).appendChild(r);
                else {
                  const e = t.parentElement.querySelectorAll("label");
                  e.length > 0 && e[0].appendChild(r);
                }
              }
            }
          }
        ),
        i
      );
    }
    validateFields() {
      this.badValue = 0;
      return (
        [...document.querySelectorAll("[data-tovalidate]")].forEach((t) => {
          const e = t.value || "",
            i = t.dataset.tovalidate || "";
          this.validate(e, i) ||
            (this.addWarnMesg(t, this.texts.wrongValue), (this.badValue += 1));
        }),
        0 === this.badValue
      );
    }
    noEmptyFields() {
      let t = 0;
      return (
        [...document.querySelectorAll("[data-required=true]")].forEach((e) => {
          if (
            "hidden" !== (e.getAttribute("type") || e.type) &&
            "true" !== e.getAttribute("data-hidden")
          ) {
            const i = e.value || "",
              r = e.getAttribute("type") || e.type || "";
            "radio" === r
              ? (t += this.checkRadioField(e))
              : "checkbox" === r
              ? e.checked
                ? this.delWarnMesg(e)
                : (this.addWarnMesg(e, this.texts.requiredField), (t += 1))
              : "" === i
              ? (this.addWarnMesg(e, this.texts.requiredField), (t += 1))
              : this.delWarnMesg(e);
          }
        }),
        0 === t
      );
    }
    checkRadioField(t) {
      let e = 0,
        i = 0;
      const r = t.getAttribute("name"),
        n = this._getParentElement(t, "form").getAttribute("id"),
        a = document.querySelector(`[data-name=${r}]`) || t;
      return (
        [...document.querySelectorAll(`#${n} [name=${r}]`)].forEach((t) => {
          t.checked && (i += 1);
        }),
        0 === i
          ? (this.addWarnMesg(a, this.texts.requiredField), (e += 1))
          : this.delWarnMesg(a),
        e
      );
    }
    addWarnMesg(t, e) {
      let i,
        r = t;
      const n = void 0 !== r.getAttribute ? r : window.event.target,
        a = "warning-" + (n.getAttribute("name") || n.getAttribute("id") || "");
      if (
        (document.getElementById(a)
          ? (i = document.getElementById(a))
          : ((r = document.getElementById(n.getAttribute("id") || r.id)),
            (i = document.createElement("p")),
            i.setAttribute("id", a)),
        i.setAttribute("style", this.cssTextWarning),
        (i.innerHTML = e),
        r.parentElement.appendChild(i),
        r.setAttribute("style", this.cssElementWarning),
        (this.numWarnings += 1),
        1 === this.numWarnings)
      ) {
        const t = r.getBoundingClientRect(),
          e = document.body.getBoundingClientRect();
        window.scrollTo(e.top, t.top);
      }
    }
    delWarnMesg(t) {
      const e = void 0 !== t.getAttribute ? t : window.event.target,
        i = e.getAttribute("name") || e.getAttribute("id") || "";
      document.getElementById("warning-" + i) &&
        e.parentElement.removeChild(document.getElementById("warning-" + i)),
        this.removeStyle(t),
        this.numWarnings > 0 && (this.numWarnings -= 1);
    }
    removeStyle(t) {
      this._null = null;
      (void 0 !== t.getAttribute ? t : window.event.target).removeAttribute(
        "style"
      );
    }
    addEventsToCheckFieldsWhenBlur(t) {
      const e = [
          ...t.getElementsByTagName("input"),
          ...t.getElementsByTagName("textarea")
        ],
        i = [...t.getElementsByTagName("select")];
      e.forEach((t) => {
        const e = document.getElementById(t.getAttribute("id")),
          i = e.getAttribute("data-required"),
          r = e.getAttribute("data-tovalidate"),
          n = e.getAttribute("type") || e.type || "";
        ("true" !== i && "" === r) ||
          (e.removeEventListener("blur", this._onBlur.bind(this), !1),
          e.addEventListener("blur", this._onBlur.bind(this), !1),
          ("checkbox" !== n && "radio" !== n) ||
            (e.removeEventListener("click", this._onBlur.bind(this), !1),
            e.addEventListener("click", this.onBlur, !1)));
      }),
        i.forEach((t) => {
          const e = document.getElementById(t.getAttribute("id"));
          "true" === e.getAttribute("data-required") &&
            (e.addEventListener("click", this._onSel.bind(this), !1),
            e.addEventListener("change", this._onSel.bind(this), !1),
            e.addEventListener("blur", this._onSel.bind(this), !1));
        });
    }
    hiddenFieldsActions() {
      [...document.querySelectorAll("[data-activate]")].forEach((t) => {
        t.classList.add("isHidden");
        const e = t.getAttribute("data-activate"),
          i = document.getElementById(e);
        if (i) {
          const e = i.getAttribute("name"),
            r = this._getParentElement(t, "form").getAttribute("id");
          [...document.querySelectorAll(`#${r} [name=${e}]`)].forEach((t) => {
            t.addEventListener("blur", this._showHidden.bind(this), !1),
              t.addEventListener("click", this._showHidden.bind(this), !1);
          });
        }
      });
    }
    _onBlur(t) {
      const { target: e } = t,
        i = e.value || "",
        r = e.dataset.tovalidate || "",
        n = Boolean(r),
        a = Boolean(e.dataset.required),
        s = e.getAttribute("type") || "";
      let l = !1;
      return (
        a &&
          ("radio" === s
            ? this.checkRadioField(e)
            : "checkbox" === s
            ? (e.checked || this.addWarnMesg(e, this.texts.requiredField),
              this.delWarnMesg(e))
            : "" === i
            ? this.addWarnMesg(e, this.texts.requiredField)
            : (this.delWarnMesg(e), (l = !0))),
        l &&
          n &&
          ((l = this.validate(i, r)),
          l
            ? this.delWarnMesg(e)
            : ((this.badValue += 1), this.addWarnMesg(e, this.texts.wrongValue))),
        l
      );
    }
    _onSel(t) {
      const { target: e } = t;
      return (
        "" === (e.value || "") && this.addWarnMesg(e, this.texts.requiredField),
        this.delWarnMesg(e),
        !0
      );
    }
    _showHidden(t) {
      this._null = null;
      const { target: e } = t;
      let i, r;
      const n = e.getAttribute("id") || "",
        a = [...document.querySelectorAll(`[data-activate*=${n}]`)],
        s = [...document.querySelectorAll(`[data-deactivate*=${n}]`)];
      a.forEach((t) => {
        t.classList.remove("isHidden"), (i = t.getAttribute("id"));
        document
          .querySelectorAll(`#${i} input[data-hidden=true]`)
          .forEach((t) => {
            t.setAttribute("data-hidden", "false");
          });
      }),
        s.forEach((t) => {
          t.classList.add("isHidden"), (r = t.getAttribute("id"));
          document
            .querySelectorAll(`#${r} input[data-hidden=false]`)
            .forEach((t) => {
              t.setAttribute("data-hidden", "true");
              const e = t.getAttribute("type") || t.type,
                i = t.parentElement;
              "LABEL" === (i.tagName.toUpperCase() || "") &&
                ("radio" === e && i.classList.remove("r_on"),
                "checkbox" === e && i.classList.remove("c_on"));
            });
        });
    }
    _getParentElement(t, e) {
      this._null = null;
      const i = e.toUpperCase();
      let r = t;
      do {
        r = r.parentElement;
      } while (null !== r && r.tagName.toUpperCase() !== i);
      return r;
    }
  }
  ValidateForm = e;
  
  const validateForm = new ValidateForm();
  var form = document.getElementById("store_alert_form");
  form.addEventListener("submit", function () {
    console.log("SENDING FORM...");
    return false;
  });

  const validateFormEmprende = new ValidateForm();
  var form = document.getElementById("store_emprende_form");
  form.addEventListener("submit", function () {
    console.log("SENDING FORM EMPRENDE...");
    return false;
  });
  