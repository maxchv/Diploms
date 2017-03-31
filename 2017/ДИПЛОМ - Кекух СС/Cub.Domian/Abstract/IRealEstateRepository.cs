using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cub.Domian.Abstract
{
    public interface IRealEstateRepository
    {
        IEnumerable<RealEstate> RealEstates { get; }
        RealEstate FaindReal(int item_id);
    }
}
