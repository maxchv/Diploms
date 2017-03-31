using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.Mvc;
using Cub.Domian.Abstract;
using Cub.Domian.Entitis;
using Cub.WebUI.Controllers;
using Cub.WebUI.HtmlHelpers;
using Cub.WebUI.Models;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using Moq;

namespace Cub.UnitTests
{
    /// <summary>
    /// Тестируем корректное отображение объектов на странице
    /// </summary>
    [TestClass]
    public class UnitTest1
    {
        //[TestMethod]
        //public void Can_Paginate()
        //{
        //    // Организация (arrange)
        //    Mock<IRealEstateRepository> mock = new Mock<IRealEstateRepository>();
        //    mock.Setup(m => m.RealEstates).Returns(new List<RealEstate>
        //    {
        //        new RealEstate { Id = 1, Rooms = 1},
        //        new RealEstate { Id = 2, Rooms = 2},
        //        new RealEstate { Id = 3, Rooms = 3},
        //        new RealEstate { Id = 4, Rooms = 4},
        //        new RealEstate { Id = 5, Rooms = 5}
        //    });
        //    RealEstateController controller = new RealEstateController(mock.Object);
        //    controller.pageSize = 3;

        //    // Действие (act)
        //    RealEstateListViewModel result = (RealEstateListViewModel)controller.List(null, 2).Model;

        //    // Утверждение (assert)
        //    List<RealEstate> realEstates = result.RealEstates.ToList();
        //    Assert.IsTrue(realEstates.Count == 2);
        //    Assert.AreEqual(realEstates[0].Rooms, 4);
        //    Assert.AreEqual(realEstates[1].Rooms, 5);
        //}

        ///// <summary>
        ///// Вызываем метод с тестовыми данными и сравниваем результаты с ожидаемой HTML-разметкой.
        ///// </summary>
        //[TestMethod]
        //public void Can_Generate_Page_Links()
        //{

        //    // Организация - определение вспомогательного метода HTML - это необходимо
        //    // для применения расширяющего метода
        //    HtmlHelper myHelper = null;

        //    // Организация - создание объекта PagingInfo
        //    PagingInfo pagingInfo = new PagingInfo
        //    {
        //        CurrentPage = 2,
        //        TotalItems = 28,
        //        ItemsPerPage = 10
        //    };

        //    // Организация - настройка делегата с помощью лямбда-выражения
        //    Func<int, string> pageUrlDelegate = i => "Page" + i;

        //    // Действие
        //    MvcHtmlString result = myHelper.PageLinks(pagingInfo, pageUrlDelegate);

        //    // Утверждение
        //    Assert.AreEqual(@"<a class=""btn btn-default"" href=""Page1"">1</a>"
        //        + @"<a class=""btn btn-default btn-primary selected"" href=""Page2"">2</a>"
        //        + @"<a class=""btn btn-default"" href=""Page3"">3</a>",
        //        result.ToString());
        //}


        ///// <summary>
        ///// Данные разбиения на страницы для модели представления
        ///// </summary>
        //[TestMethod]
        //public void Can_Send_Pagination_View_Model()
        //{
        //    // Организация (arrange)
        //    Mock<IRealEstateRepository> mock = new Mock<IRealEstateRepository>();
        //    mock.Setup(m => m.RealEstates).Returns(new List<RealEstate>
        //    {
        //        new RealEstate { Id = 1, Rooms = 1},
        //        new RealEstate { Id = 2, Rooms = 2},
        //        new RealEstate { Id = 3, Rooms = 3},
        //        new RealEstate { Id = 4, Rooms = 4},
        //        new RealEstate { Id = 5, Rooms = 5}
        //    });
        //    RealEstateController controller = new RealEstateController(mock.Object);
        //    controller.pageSize = 3;

        //    // Act
        //    RealEstateListViewModel result
        //        = (RealEstateListViewModel)controller.List(null, 2).Model;

        //    // Assert
        //    PagingInfo pageInfo = result.PagingInfo;
        //    Assert.AreEqual(pageInfo.CurrentPage, 2);
        //    Assert.AreEqual(pageInfo.ItemsPerPage, 3);
        //    Assert.AreEqual(pageInfo.TotalItems, 5);
        //    Assert.AreEqual(pageInfo.TotalPages, 2);
        //}

        ///// <summary>
        ///// Модульное тестирование: фильтрация по категории
        ///// </summary>
        //[TestMethod]
        //public void Can_Filter_RealEstate()
        //{
        //    // Организация (arrange)
        //    Mock<IRealEstateRepository> mock = new Mock<IRealEstateRepository>();
        //    mock.Setup(m => m.RealEstates).Returns(new List<RealEstate>
        //    {
        //        new RealEstate { Id = 1, Rooms = 1, TypeOfOperations = "Cat1"},
        //        new RealEstate { Id = 2, Rooms = 2, TypeOfOperations = "Cat2"},
        //        new RealEstate { Id = 3, Rooms = 3, TypeOfOperations = "Cat1"},
        //        new RealEstate { Id = 4, Rooms = 4, TypeOfOperations = "Cat2"},
        //        new RealEstate { Id = 5, Rooms = 5, TypeOfOperations = "Cat3"}
        //    });
        //    RealEstateController controller = new RealEstateController(mock.Object);
        //    controller.pageSize = 3;

        //    // Action
        //    List<RealEstate> result = ((RealEstateListViewModel)controller.List("Cat2", 1).Model)
        //        .RealEstates.ToList();

        //    // Assert
        //    Assert.AreEqual(result.Count(), 2);
        //    Assert.IsTrue(result[0].Rooms == 2 && result[0].TypeOfOperations == "Cat2");
        //    Assert.IsTrue(result[1].Rooms == 4 && result[1].TypeOfOperations == "Cat2");
        //}

        ///// <summary>
        ///// Модульное тестирование: генерация списка категорий
        ///// </summary>
        //[TestMethod]
        //public void Can_Create_TypeOfOperations()
        //{
        //    // Организация - создание имитированного хранилища
        //    Mock<IRealEstateRepository> mock = new Mock<IRealEstateRepository>();
        //    mock.Setup(m => m.RealEstates).Returns(new List<RealEstate> {
        //                new RealEstate { Id = 1, Rooms = 1, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 2, Rooms = 2, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 3, Rooms = 3, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 4, Rooms = 4, TypeOfOperations = "Сдам"},
        //                new RealEstate { Id = 5, Rooms = 5, TypeOfOperations = "Сниму"}
        //    });

        //    // Организация - создание контроллера
        //    NavController target = new NavController(mock.Object);

        //    // Действие - получение набора категорий
        //    List<string> results = ((IEnumerable<string>)target.Menu().Model).ToList();

        //    // Утверждение
        //    Assert.AreEqual(results.Count(), 3);
        //    Assert.AreEqual(results[0], "Продам");
        //    Assert.AreEqual(results[1], "Сдам");
        //    Assert.AreEqual(results[2], "Сниму");
        //}
        ///// <summary>
        ///// Модульное тестирование: сообщение о выбранной категории
        ///// </summary>
        //[TestMethod]
        //public void Indicates_Selected_TypeOfOperations()
        //{
        //    // Организация - создание имитированного хранилища
        //    Mock<IRealEstateRepository> mock = new Mock<IRealEstateRepository>();
        //    mock.Setup(m => m.RealEstates).Returns(new List<RealEstate> {
        //                new RealEstate { Id = 1, Rooms = 1, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 2, Rooms = 2, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 3, Rooms = 3, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 4, Rooms = 4, TypeOfOperations = "Сдам"},
        //                new RealEstate { Id = 5, Rooms = 5, TypeOfOperations = "Сниму"}
        //    });

        //    // Организация - создание контроллера
        //    NavController target = new NavController(mock.Object);
        //    string typeToSelect = "Сдам";
        //    // Действие
        //    string result = target.Menu(typeToSelect).ViewBag.SelectedTypeOperation;

        //    // Утверждение
        //    Assert.AreEqual(typeToSelect, result);
        //}

        ///// <summary>
        ///// Модульное тестирование: счетчик товаров определенной категории
        ///// </summary>
        //[TestMethod]
        //public void Generate_Category_Specific_RealEstate_Count()
        //{
        //    /// Организация (arrange)
        //    Mock<IRealEstateRepository> mock = new Mock<IRealEstateRepository>();
        //    mock.Setup(m => m.RealEstates).Returns(new List<RealEstate> {
        //                new RealEstate { Id = 1, Rooms = 1, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 2, Rooms = 2, TypeOfOperations = "Сдам"},
        //                new RealEstate { Id = 3, Rooms = 3, TypeOfOperations = "Продам"},
        //                new RealEstate { Id = 4, Rooms = 4, TypeOfOperations = "Сдам"},
        //                new RealEstate { Id = 5, Rooms = 5, TypeOfOperations = "Сниму"}
        //    });
        //    RealEstateController controller = new RealEstateController(mock.Object);
        //    controller.pageSize = 3;

        //    // Действие - тестирование счетчиков товаров для различных категорий
        //    int res1 = ((RealEstateListViewModel)controller.List("Продам").Model).PagingInfo.TotalItems;
        //    int res2 = ((RealEstateListViewModel)controller.List("Сдам").Model).PagingInfo.TotalItems;
        //    int res3 = ((RealEstateListViewModel)controller.List("Сниму").Model).PagingInfo.TotalItems;
        //    int resAll = ((RealEstateListViewModel)controller.List(null).Model).PagingInfo.TotalItems;

        //    // Утверждение
        //    Assert.AreEqual(res1, 2);
        //    Assert.AreEqual(res2, 2);
        //    Assert.AreEqual(res3, 1);
        //    Assert.AreEqual(resAll, 5);
        //}
    }
}
