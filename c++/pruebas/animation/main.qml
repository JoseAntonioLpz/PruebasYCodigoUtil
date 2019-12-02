import QtQuick 2.12
import QtQuick.Window 2.12

Window {
    id: mainWindow
    visible: true
    width: 640
    height: 480
    title: qsTr("Hello World")
    color: "cyan";

    Component.onCompleted: showMaximized();
    Item {
        id: mainItem
        anchors.fill: parent
        focus: true
        Keys.onPressed: {
            //if (event.key === Qt.Key_Space) console.log("Space Key")
            console.log(switchKey(event.key));
        }

        Item{
            anchors.fill: parent
            Rectangle {
                color: "red";
                width: 20;
                height: 20;
                x: Screen.desktopAvailableWidth;
                y: Screen.desktopAvailableHeight / Math.floor((Math.random() * 10));
                NumberAnimation on x{
                    from: Screen.desktopAvailableWidth
                    to: 0
                    duration: 3000
                    loops: Animation.Infinite
                }
            }
            //Component.onCompleted: createObjects(this, Screen.desktopAvailableWidth, Screen.desktopAvailableHeight / Math.floor((Math.random() * 10)));
        }

        Rectangle{
            id: greenRectagle
            //anchors.left: parent.left
            //anchors.right: parent.right
            width: Screen.desktopAvailableWidth + 174
            anchors.top: parent.verticalCenter
            anchors.bottom: parent.bottom
            color: "green"
            Image { source: "images/texture.jpg"; fillMode: Image.Tile; anchors.fill: parent;  opacity: 0.3 }
            NumberAnimation on x{
                from: 0
                to: -174
                duration: 1000
                loops: Animation.Infinite
            }
        }

        AnimatedSprite {
            width: 125
            height: 127
            id: spriteImage
            source: "images/sprite4.png"
            frameWidth: 250
            frameHeight: 245
            frameCount: 6
            frameDuration: 60
            frameY : 0
            /*interpolate: false*/
            y: Screen.desktopAvailableHeight / 2 - spriteImage.height
        }
    }

    function switchKey(key){
        switch(key){
        case Qt.Key_Space:
            return "space";
        default:
            return false;
        }
    }

    function createObjects(parentItem, x, y){
        var newObject = Qt.createQmlObject(
                            'import QtQuick 2.0;
                            Rectangle {color: "red"; width: 20;height: 20;x: ' + x + '; y:' + y + ';
NumberAnimation on x{
                from: ' + x + '
                to: 0
                duration: 1000
                loops: Animation.Infinite
            }}',
                            parentItem,
                            "dinamicObject");

        //newObject.destroy(1000);
    }
}
