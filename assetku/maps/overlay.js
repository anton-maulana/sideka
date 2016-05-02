var overlay;
DebugOverlay.prototype = new google.maps.OverlayView();

function DebugOverlay(bounds, image, map) {

      this.bounds_ = bounds;
      this.image_ = image;
      this.map_ = map;
      this.div_ = null;
      this.setMap(map);
    }

    
	DebugOverlay.prototype.onAdd = function() {
	  var div = document.createElement('div');
	  div.style.borderStyle = 'none';
	  div.style.borderWidth = '0px';
	  div.style.position = 'absolute';
	  var img = document.createElement('img');
	  img.src = this.image_;
	  img.style.width = '100%';
	  img.style.height = '100%';
	  img.style.opacity = '1';
	  img.style.position = 'absolute';
	  div.appendChild(img);
	  this.div_ = div;
	  var panes = this.getPanes();
	  panes.overlayLayer.appendChild(div);
	};
	
    DebugOverlay.prototype.draw = function() {
      var overlayProjection = this.getProjection();
      var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
      var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());
      var div = this.div_;
      div.style.left = sw.x + 'px';
      div.style.top = ne.y + 'px';
      div.style.width = (ne.x - sw.x) + 'px';
      div.style.height = (sw.y - ne.y) + 'px';
	  
    };


    DebugOverlay.prototype.updateBounds = function(bounds){
    	this.bounds_ = bounds;
    	this.draw();
    };

    DebugOverlay.prototype.onRemove = function() {
      this.div_.parentNode.removeChild(this.div_);
      this.div_ = null;
    };
	
	// Set the visibility to 'hidden' or 'visible'.
	DebugOverlay.prototype.hide = function() {
	  if (this.div_) {
		// The visibility property must be a string enclosed in quotes.
		this.div_.style.visibility = 'hidden';
	  }
	};

	DebugOverlay.prototype.show = function() {
	  if (this.div_) {
		this.div_.style.visibility = 'visible';
	  }
	};
	
	DebugOverlay.prototype.geserOpacity = function() {
	  if (this.div_) {
		this.div_.style.opacity = '0.6';
	  }
	};
	
	DebugOverlay.prototype.endGeserOpacity = function() {
	  if (this.div_) {
		this.div_.style.opacity = '1';
	  }
	};

	DebugOverlay.prototype.toggle = function() {
	  if (this.div_) {
		if (this.div_.style.visibility === 'hidden') {
		  this.show();
		} else {
		  this.hide();
		}
	  }
	};

	// Detach the map from the DOM via toggleDOM().
	// Note that if we later reattach the map, it will be visible again,
	// because the containing <div> is recreated in the overlay's onAdd() method.
	DebugOverlay.prototype.toggleDOM = function() {
	  if (this.getMap()) {
		// Note: setMap(null) calls OverlayView.onRemove()
		this.setMap(null);
	  } else {
		this.setMap(this.map_);
	  }
	};