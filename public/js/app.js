function Alert(e,t){const o=$(`<div class="alert alert-${t}" role="alert"></div>`).text(e);["primary","secondary","success","danger","warning","info","light","dark"].includes(t)?($("#alerts").append(o),setTimeout((function(){o.addClass("show")}),100),setTimeout((function(){o.removeClass("show"),setTimeout((function(){o.remove()}),1e3)}),2e3)):console.error("The alert type entered is invalid or not supported.")}