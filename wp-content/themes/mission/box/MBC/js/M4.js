function GalleryNavigator() {
    var counter=0;
    var imgTotal=5;
    this.counter = counter, this.imgTotal=imgTotal;
    this.slideShowInterruptus = false;
    this.slideShowIntervalID = 0;
    var me=this;
    
    var prevArrow = document.getElementById("left-arrow").addEventListener("click", function() { 
            me.previous();
            me.slideShowInterruptus = false;
            me.stopSlideShow();
        });
    var nextArrow = document.getElementById("right-arrow").addEventListener("click", function() { 
            me.next();
            me.slideShowInterruptus = false;
            me.stopSlideShow();
        });
        
    setTimeout(function() {
        me.startSlideShow();
    }, 9000);
}

GalleryNavigator.prototype.next = function(){
    if (this.counter) document.getElementById("img-"+this.counter).style.display='none';
    this.counter = (++this.counter > this.imgTotal) ? 0 : this.counter ;
    if (this.counter) document.getElementById("img-"+this.counter).style.display='block';    
};
GalleryNavigator.prototype.previous = function(){
    if (this.counter) document.getElementById("img-"+this.counter).style.display='none';
    this.counter = (--this.counter < 0 ) ? this.imgTotal : this.counter ;
    if (this.counter) document.getElementById("img-"+this.counter).style.display='block';    
};
GalleryNavigator.prototype.photoFadeIn = function(counter){
    var cssString = "opacity:0; display:block;";
    if (counter) {
        var photoNode = document.getElementById("img-"+counter);
        photoNode.style.cssText += cssString;
        photoNode.className = photoNode.className +" fadeIn";
        var dropFadeInFunc = function(photoDOM){
            return function () {
                
            };
        };
        setTimeout(function(){
            
        }, 1000);
        
        return true;
    }
    else return false;    
};

GalleryNavigator.prototype.startSlideShow = function(){
    var me = this;
    if (!this.slideShowInterruptus) 
        this.slideShowIntervalID = setInterval( function() {
            me.next();
        }, 2500);
    var allPhotos = document.querySelectorAll(".pg-img");
    for (var i=0, l = allPhotos.length, photo; i<l; i++) {
        photo= allPhotos[i];
        photo.addEventListener("click", function() { 
            me.stopSlideShow();
        });
    }
    return;
};

GalleryNavigator.prototype.stopSlideShow = function(){
    window.clearInterval(this.slideShowIntervalID);
};

GalleryNavigator.prototype.doNothing = function(){
    return;
}
