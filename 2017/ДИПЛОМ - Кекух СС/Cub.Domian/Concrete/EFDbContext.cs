using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Cub.Domian.Entitis;

namespace Cub.Domian.Concrete
{
    public class EFDbContext:DbContext
    {
        public EFDbContext()
            : base("EFDbContext")
        {
        }
        public DbSet<RealEstate> RealEstates { get; set; }
        public DbSet<Order> Orders { get; set; }
        public DbSet<OrderClient> OrderClients { get; set; }
       
    }
}
