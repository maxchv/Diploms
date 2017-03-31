using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Cub.Domian.Concrete;
using Cub.Domian.Entitis;
using System.IO;

namespace Cub.WebUI.Areas.Admin.Controllers
{
    [Authorize]
    public class RealEstatesController : Controller
    {
        private EFDbContext db = new EFDbContext();

        // GET: Admin/RealEstates/Index
        [Authorize]
        public ActionResult Index()
        {
            return View(db.RealEstates.ToList());
        }

        // GET: Admin/RealEstates/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            RealEstate realEstate = db.RealEstates.Find(id);
            if (realEstate == null)
            {
                return HttpNotFound();
            }
            return View(realEstate);
        }

        // GET: Admin/RealEstates/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Admin/RealEstates/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Type,Category,InhabitedLocalityAndDistrict,Citi,Rooms,HundredPart,Square,Additionally,Budget,PhoneNumber,Date,Tags,Info,TypeOfOperations,imgOne,imgTwo,imgThree,imgFhore,imgFive")] RealEstate realEstate, HttpPostedFileBase image1, HttpPostedFileBase image2, HttpPostedFileBase image3, HttpPostedFileBase image4, HttpPostedFileBase image5)
        {
            if (ModelState.IsValid)
            {
                if (image1 != null)
                {
                    byte[] imageData1 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image1.InputStream))
                    {
                        imageData1 = binaryReader.ReadBytes(image1.ContentLength);
                    }
                    realEstate.imgOne = imageData1;
                }
                if (image2 != null)
                {
                    byte[] imageData2 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image2.InputStream))
                    {
                        imageData2 = binaryReader.ReadBytes(image2.ContentLength);
                    }
                    realEstate.imgTwo = imageData2;
                }
                if (image3 != null)
                {
                    byte[] imageData3 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image3.InputStream))
                    {
                        imageData3 = binaryReader.ReadBytes(image3.ContentLength);
                    }
                    realEstate.imgThree = imageData3;
                }
                if (image4 != null)
                {
                    byte[] imageData4 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image4.InputStream))
                    {
                        imageData4 = binaryReader.ReadBytes(image4.ContentLength);
                    }
                    realEstate.imgFhore = imageData4;
                }
                if (image5 != null)
                {
                    byte[] imageData5 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image5.InputStream))
                    {
                        imageData5 = binaryReader.ReadBytes(image5.ContentLength);
                    }
                    realEstate.imgFive = imageData5;
                }
                db.Entry(realEstate).State = System.Data.Entity.EntityState.Added;                
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(realEstate);
        }

        // GET: Admin/RealEstates/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            RealEstate realEstate = db.RealEstates.Find(id);
            if (realEstate == null)
            {
                return HttpNotFound();
            }
            return View(realEstate);
        }

        // POST: Admin/RealEstates/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,Type,Category,InhabitedLocalityAndDistrict,Citi,Rooms,HundredPart,Square,Additionally,Budget,PhoneNumber,Date,Tags,Info,TypeOfOperations,imgOne,imgTwo,imgThree,imgFhore,imgFive")] RealEstate realEstate, HttpPostedFileBase image1, HttpPostedFileBase image2, HttpPostedFileBase image3, HttpPostedFileBase image4, HttpPostedFileBase image5)
        {
            if (ModelState.IsValid)
            {
                if (image1 != null)
                {
                    byte[] imageData1 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image1.InputStream))
                    {
                        imageData1 = binaryReader.ReadBytes(image1.ContentLength);
                    }
                    realEstate.imgOne = imageData1;
                }
                if (image2 != null)
                {
                    byte[] imageData2 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image2.InputStream))
                    {
                        imageData2 = binaryReader.ReadBytes(image2.ContentLength);
                    }
                    realEstate.imgTwo = imageData2;
                }
                if (image3 != null)
                {
                    byte[] imageData3 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image3.InputStream))
                    {
                        imageData3 = binaryReader.ReadBytes(image3.ContentLength);
                    }
                    realEstate.imgThree = imageData3;
                }
                if (image4 != null)
                {
                    byte[] imageData4 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image4.InputStream))
                    {
                        imageData4 = binaryReader.ReadBytes(image4.ContentLength);
                    }
                    realEstate.imgFhore = imageData4;
                }
                if (image5 != null)
                {
                    byte[] imageData5 = null;
                    // считываем переданный файл в массив байтов
                    using (var binaryReader = new BinaryReader(image5.InputStream))
                    {
                        imageData5 = binaryReader.ReadBytes(image5.ContentLength);
                    }
                    realEstate.imgFive = imageData5;
                }
                            
                db.Entry(realEstate).State = System.Data.Entity.EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(realEstate);
        }

        // GET: Admin/RealEstates/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            RealEstate realEstate = db.RealEstates.Find(id);
            if (realEstate == null)
            {
                return HttpNotFound();
            }
            return View(realEstate);
        }

        // POST: Admin/RealEstates/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            RealEstate realEstate = db.RealEstates.Find(id);
            db.RealEstates.Remove(realEstate);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
