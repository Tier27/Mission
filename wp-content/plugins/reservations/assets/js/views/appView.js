var AppView = Backbone.View.extend({
    tagName: "body",

    initialize: function () {
      this.render();
    },

    events: {
    },

    render: function() {
      this.$el.html("");
    },
  });
});

window.app = new AppView($("body"));