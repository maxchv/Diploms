using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Configuration;
using System.Web.Mvc;
using Moq;
using Ninject;
using Cub.Domian.Abstract;
using Cub.Domian.Concrete;
using Cub.Domian.Entitis;
using Cub.WebUI.Infrastructure.Abstract;
using Cub.WebUI.Infrastructure.Concrete;

namespace Cub.WebUI.Infrastructure
{
    public class NinjectDependencyResolver : IDependencyResolver
    {
        private IKernel kernel;

        public NinjectDependencyResolver(IKernel kernelParam)
        {
            kernel = kernelParam;
            AddBindings();
        }

        private void AddBindings()
        {
            kernel.Bind<IRealEstateRepository>().To<EFRealEstateRepository>();
            kernel.Bind<IOrderRepository>().To<EFOrderRepository>();
            kernel.Bind<IOrderСlientRepository>().To<EFOrderClientRepository>();
            kernel.Bind<IAuthProvider>().To<FormAuthProvider>();
        }

        public object GetService(Type serviceType)
        {
            return kernel.TryGet(serviceType);
        }

        public IEnumerable<object> GetServices(Type serviceType)
        {
            return kernel.GetAll(serviceType);
        }

    }
}