jQuery(document).ready(function(){wp_gallery_custom_links_setup();function addLoadEvent(func){var oldOnload=window.onload;if(typeof window.onload!='function'){window.onload=func;}else{window.onload=function(){oldOnload();func();}}}
addLoadEvent(wp_gallery_custom_links_setup);});function wp_gallery_custom_links_setup(){if(jQuery.fn.off){jQuery('.no-lightbox, .no-lightbox img').off('click');}else{jQuery('.no-lightbox, .no-lightbox img').unbind('click');}
jQuery('a.no-lightbox').click(wp_gallery_custom_links_click);if(jQuery.fn.off){jQuery('a.set-target').off('click');}else{jQuery('a.set-target').unbind('click');}
jQuery('a.set-target').click(wp_gallery_custom_links_click);}
function wp_gallery_custom_links_click(){if(!this.target||this.target==''||this.target=='_self')
window.location=this.href;else
window.open(this.href,this.target);return false;}