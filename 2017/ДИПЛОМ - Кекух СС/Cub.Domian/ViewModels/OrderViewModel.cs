using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Web.Mvc;

namespace Cub.Domian.ViewModels
{
    class OrderViewModel
    {
        public Order Order { get; set; }
        public SelectList Products { get; set; }
    }
}
