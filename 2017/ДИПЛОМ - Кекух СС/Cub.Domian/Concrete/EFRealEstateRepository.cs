using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Cub.Domian.Abstract;
using Cub.Domian.Entitis;
using System.Data.Entity;

namespace Cub.Domian.Concrete
{
    public class EFRealEstateRepository : IRealEstateRepository
    {
        EFDbContext context = new EFDbContext();
        public IEnumerable<RealEstate> RealEstates
        {
            get { return context.RealEstates; }
        }

        public RealEstate FaindReal(int item_id)
        {
            RealEstate realEstate = context.RealEstates.Find(item_id);
            return (realEstate);
        }
    }
}
