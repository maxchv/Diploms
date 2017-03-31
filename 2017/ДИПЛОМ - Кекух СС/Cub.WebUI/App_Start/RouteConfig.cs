using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Web.Routing;

namespace Cub.WebUI
{
    public class RouteConfig
    {
        public static void RegisterRoutes(RouteCollection routes)
        {
            routes.IgnoreRoute("{resource}.axd/{*pathInfo}");

            routes.MapRoute(
                name: "Default",
                url: "{controller}/{action}",
                defaults: new { controller = "RealEstate", action = "Index" }
            );

            routes.MapRoute(
                name:null,
                url:"",
                defaults:new
                {
                    controller = "RealEstate",
                    action = "List",                    
                    typeOperation = (string)null,
                    page = 1
                }
            );
            routes.MapRoute(
                 name: null,
                 url: "Page{page}",
                 defaults: new { controller = "RealEstate", action = "List", typeOperation = (string)null },
                 constraints: new { page = @"\d+" }
             );


            routes.MapRoute(
                name: null,
                url: "",
                defaults: new
                {
                    controller = "RealEstate",
                    action = "ListAll",
                    typeOperation = (string)null,
                    page = 1
                }
            );            
            routes.MapRoute(
                 name: null,
                 url: "Page{page}",
                 defaults: new { controller = "RealEstate", action = "ListAll",  typeOperation = (string)null },
                 constraints: new { page = @"\d+" }
             );

            routes.MapRoute(
                name: null,
                url: "",
                defaults: new
                {
                    controller = "RealEstate",
                    action = "ListAllFilter",
                    costOf = (string)null,
                    costBegin = (string)null,
                    rayon = (string)null,
                    citi = (string)null,
                    category = (string)null,
                    typeOperation = (string)null,
                    page = 1
                }
            );
            //routes.MapRoute(
            //    name: null,
            //    url: "",
            //    defaults: new
            //    {
            //        controller = "OrderClient",
            //        action = "ModalFormOnePage",
            //        typeOfLodging = (string)null,
            //        Relev = (string)null,
            //        OurOffer = (string)null,
            //        value = (string)null 
            //    }
            //);
            routes.MapRoute(
                 name: null,
                 url: "Page{page}",
                 defaults: new { controller = "RealEstate", action = "ListAllFilter", typeOperation = (string)null },
                 constraints: new { page = @"\d+" }
             );




            routes.MapRoute(null,
                "{typeOperation}",
                new { controller = "RealEstate", action = "List", page = 1 }
            );

            routes.MapRoute(null,
                "{typeOperation}/Page{page}",
                new { controller = "RealEstate", action = "List" },
                new { page = @"\d+" }
            );

            routes.MapRoute(null, "{controller}/{action}");

            

        }
    }
}
